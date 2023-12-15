<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Order\StoreUpdateRequest;

class OrderController extends Controller
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
        $data = Order::with('customer')
            ->whereHas('laundryService')
            ->whereHas('customer')
            ->when($request->has('search'), function ($q) use ($request) {
                $q->whereHas('customer', function ($subQ) use ($request) {
                    $subQ->where('name', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('order_code', 'like', '%' . $request->input('search') . '%');
                });
            })
            ->when(auth()->user()->hasRole('staff'), function ($query) {
                return $query->where('laundry_staff_id', auth()->user()->staff_id);
            })
            ->latest()
            ->paginate($request->perPage ?? 10);


        return view('order.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateRequest $request)
    {
        DB::beginTransaction();
        try {

            Order::create($request->validated());

            DB::commit();
            return redirect($request->get('next', route('order.index')))
                ->with(['success' => 'Sukses, Transaksi berhasil ditambah']);
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
    public function edit(Order $order)
    {
        return view('order.process', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:0,1',
            'order_status' => 'required|in:process,ready,taken'
        ]);

        DB::beginTransaction();
        try {

            $order->update([
                'payment_status' => $request->payment_status,
                'order_status'  => $request->order_status,
                'taken_at' => $request->order_status == 'taken' ? now() : null
            ]);

            DB::commit();
            return redirect($request->get('next', route('order.index')))
                ->with(['success' => 'Sukses, Transaksi berhasil diubah']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {

            $order->delete();

            DB::commit();
            return back()
                ->with(['success' => 'Sukses, Transaksi berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()
                ->with(['success' => 'Gagal, Transaksi gagal dihapus']);
        }
    }

    /**
     * Print
     *
     * @return View
     */
    public function print(Order $order)
    {
        return view('order.nota_kecil', compact('order'));
    }
}
