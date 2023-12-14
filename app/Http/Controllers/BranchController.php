<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Branch\StoreUpdateRequest;
use App\Http\Requests\Branch\UpdateRequest;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{
    /**
     * Instantiate a new PostController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Branch::when($request->get('search'), function($q) {
                    $q->where('name', 'like', '%'.request('search', '').'%');
                })->paginate($request->perPage ?? 10);

        return view('branch.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {

            $branch = Branch::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'description' => $request->description,
                'status' => $request->status
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'branch_id' => $branch->id
            ]);

            $user->syncRoles('branch');

            DB::commit();
            return redirect($request->get('next', route('branch.index')))
                ->with(['success' => 'Sukses, Cabang berhasil ditambah']);
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
    public function edit(Branch $branch)
    {
        return view('branch.form', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Branch $branch)
    {
        DB::beginTransaction();
        try {

            $branch->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'description' => $request->description,
                'status' => $request->status
            ]);

            $branch->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->has('password')) {
                $branch->user->update([
                    'password' =>  Hash::make($request->password)
                ]);
            }

            DB::commit();
            return redirect($request->get('next', route('branch.index')))
                ->with(['success' => 'Sukses, Cabang berhasil diubah']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        DB::beginTransaction();
        try {

            $branch->delete();
            $branch->user()->delete();

            DB::commit();
            return back()
                ->with(['success' => 'Sukses, Cabang berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()
                ->with(['success' => 'Gagal, Cabang gagal dihapus']);
        }
    }
}
