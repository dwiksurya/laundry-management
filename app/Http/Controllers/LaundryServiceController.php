<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LaundryService\StoreUpdateRequest;

class LaundryServiceController extends Controller
{
    /**
     * Instantiate a new PostController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:branch');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = LaundryService::when($request->get('search'), function($q) {
                    $q->where('name', 'like', '%'.request('search', '').'%');
                })->paginate($request->perPage ?? 10);

        return view('laundry_service.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laundry_service.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateRequest $request)
    {
        DB::beginTransaction();
        try {

            LaundryService::create($request->validated());

            DB::commit();
            return redirect($request->get('next', route('laundry-service.index')))
                ->with(['success' => 'Sukses, Paket Laundry berhasil ditambah']);
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
    public function edit(LaundryService $laundryService)
    {
        return view('laundry_service.form', compact('laundryService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRequest $request, LaundryService $laundryService)
    {
        DB::beginTransaction();
        try {

            $laundryService->update($request->validated());

            DB::commit();
            return redirect($request->get('next', route('laundry-service.index')))
                ->with(['success' => 'Sukses, Paket Laundry berhasil diubah']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaundryService $laundryService)
    {
        DB::beginTransaction();
        try {

            $laundryService->delete();

            DB::commit();
            return back()
                ->with(['success' => 'Sukses, Paket Laundry berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()
                ->with(['success' => 'Gagal, Paket Laundry gagal dihapus']);
        }
    }
}
