<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Customer\StoreUpdateRequest;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Instantiate a new PostController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:branch|staff');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Customer::when($request->get('search'), function($q) {
                    $q->where('name', 'like', '%'.request('search', '').'%');
                })->paginate($request->perPage ?? 10);

        return view('customer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateRequest $request)
    {
        DB::beginTransaction();
        try {

            Customer::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number
            ]);

            DB::commit();
            return redirect($request->get('next', route('customer.index')))
                ->with(['success' => 'Sukses, Pelanggan berhasil ditambah']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer.form', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRequest $request, Customer $customer)
    {
        DB::beginTransaction();
        try {

            $customer->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number
            ]);

            DB::commit();
            return redirect($request->get('next', route('customer.index')))
                ->with(['success' => 'Sukses, Pelanggan berhasil diubah']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        DB::beginTransaction();
        try {

            $customer->delete();

            DB::commit();
            return back()
                ->with(['success' => 'Sukses, Pelanggan berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()
                ->with(['success' => 'Gagal, Pelanggan gagal dihapus']);
        }
    }
}
