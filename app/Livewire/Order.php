<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\LaundryService;
use Illuminate\Support\Facades\DB;
use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\Log;

class Order extends Component
{
    public $isNewCustomer = false;
    public $customers;
    public $laundryServices;
    public $customerId;
    public $orderDate;
    public $paymentStatus;
    public $laundryServiceId;
    public $laundryService;
    public $amount;
    public $name;
    public $phoneNumber;
    public $laundryServiceType= 'kilos';
    public $orders = ['laundryServiceId' => null];

    public function render()
    {

        $this->customers = Customer::whereBranchId(auth()->user()->branch_id)
                            ->pluck('name', 'id');

        $this->laundryServices = LaundryService::whereBranchId(auth()->user()->branch_id)
                            ->pluck('name', 'id');

        return view('livewire.order');
    }

    /**
     * Add laundry services
     *
     * @return void
     */
    public function saveForm()
    {
        $this->validate([
            'name' => $this->isNewCustomer ? 'required|string|max:255' : 'nullable',
            'customerId' => !$this->isNewCustomer ? 'required|integer|exists:customers,id' : 'nullable',
            'phoneNumber' => 'nullable|string|max:20',
            'orderDate' => 'required|date',
            'paymentStatus' => 'required|in:0,1',
            'laundryServiceId' => 'required|exists:laundry_services,id',
            'amount' => 'required|numeric|min:1'
        ]);

        DB::beginTransaction();

        try {
            if ($this->isNewCustomer) {
                $customer = Customer::create([
                    'name' => $this->name,
                    'phone_number' => $this->phoneNumber
                ]);
            }

            OrderModel::create([
                'customer_id' => $this->isNewCustomer ? $customer->id : $this->customerId,
                'order_date'  => $this->orderDate,
                'payment_status' => $this->paymentStatus,
                'payment_at' => $this->paymentStatus ? now() : null,
                'laundry_service_id' => $this->laundryServiceId,
                'amount' => $this->amount,
                'total' => $this->amount*$this->laundryService->price
            ]);

            DB::commit();
            session()->flash('success', 'Order successfully created.');
            $this->redirectRoute('order.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            session()->flash('error', 'Order failed to created.');
        }
    }


    /**
     * Add laundry services
     *
     * @return void
     */
    public function addLaundryService()
    {
        $this->orders[] = ['laundryServiceId' => null];
    }

    /**
     * Remove laundry services
     *
     * @return void
     */
    public function removeLaundryService($key)
    {
        unset($this->orders[$key]);
        $this->orders = array_values($this->orders);
    }

    /**
     * Set new customer form
     *
     * @return void
     */
    public function setNewCustomer()
    {
        $this->isNewCustomer = !$this->isNewCustomer;
    }

    public function updated($property)
    {
        if ($property === 'laundryServiceId') {
            if (!is_null($this->laundryServiceId)) {
                $this->laundryServiceType =  LaundryService::find($this->laundryServiceId)->type ?? null;
                $this->laundryService =  LaundryService::find($this->laundryServiceId);
            }
        }
    }
}
