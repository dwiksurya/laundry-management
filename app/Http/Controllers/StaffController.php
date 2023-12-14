<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LaundryStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Staff\StoreRequest;
use App\Http\Requests\Staff\UpdateRequest;

class StaffController extends Controller
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
        $data = LaundryStaff::when($request->get('search'), function($q) {
                    $q->where('name', 'like', '%'.request('search', '').'%');
                })->paginate($request->page ?? 10);

        return view('staff.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {

            $staff = LaundryStaff::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'staff_id' => $staff->id,
                'branch_id' => auth()->user()->branch_id
            ]);

            $user->syncRoles('staff');

            DB::commit();
            return redirect($request->get('next', route('staff.index')))
                ->with(['success' => 'Sukses, Karyawan berhasil ditambah']);
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
    public function edit(LaundryStaff  $staff)
    {
        return view('staff.form', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,LaundryStaff  $staff)
    {
        DB::beginTransaction();
        try {

            $staff->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number
            ]);

            $staff->user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            if ($request->has('password')) {
                $staff->user->update([
                    'password' =>  Hash::make($request->password)
                ]);
            }

            DB::commit();
            return redirect($request->get('next', route('staff.index')))
                ->with(['success' => 'Sukses, Karyawan berhasil diubah']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaundryStaff $staff)
    {
        DB::beginTransaction();
        try {

            $staff->delete();
            $staff->user()->delete();

            DB::commit();
            return back()
                ->with(['success' => 'Sukses, Karyawan berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()
                ->with(['success' => 'Gagal, Karyawan gagal dihapus']);
        }
    }
}
