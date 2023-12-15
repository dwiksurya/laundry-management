<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\LaundryService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branch = Branch::query();
        $orders = Order::query()
                    ->whereHas('customer')
                    ->whereHas('laundryService')
                    ->whereDate('order_date', Carbon::today());

        $customers = Customer::query();

        $laundryServices = LaundryService::query()
                            ->whereHas('orders', function ($query) {
                                $query->where('created_at', '>=', Carbon::now()->subDays(7));
                            })
                            ->withCount(['orders' => function ($query) {
                                $query->where('created_at', '>=', Carbon::now()->subDays(7));
                            }])
                            ->orderByDesc('orders_count')
                            ->take(5);

        $topBranches = Branch::query()
                            ->withCount('customers')
                            ->orderByDesc('customers_count')
                            ->take(5);

        if (Auth::user()->hasRole('branch')) {
            return view('dashboard.branch', [
                'todayOrders' => $orders->where('branch_id', auth()->user()->branch_id)->count(),
                'todayIncomes' => $orders->where('branch_id', auth()->user()->branch_id)->sum('total'),
                'totalCustomers' => $customers->whereHas('orders', function($q) {
                        $q->where('branch_id', auth()->user()->branch_id);
                    })->count(),
                'topLaundryServices' => $laundryServices->where('branch_id', auth()->user()->branch_id)
                    ->get()
            ]);
        }

        if (Auth::user()->hasRole('staff')) {
            return view('dashboard.staff', [
                'todayOrders' => $orders->where('laundry_staff_id', auth()->user()->staff_id)->count(),
                'todayIncomes' => $orders->where('laundry_staff_id', auth()->user()->staff_id)->sum('total'),
                'totalCustomers' => $customers->whereHas('orders', function($q) {
                        $q->where('laundry_staff_id', auth()->user()->staff_id);
                    })->count()
            ]);
        }

        return view('dashboard.index', [
            'totalActiveBranchs' => $branch->where('status', '1')->count(),
            'totalInactiveBranchs' => $branch->where('status', '0')->count(),
            'topBranches' => $topBranches->get()
        ]);
    }
}
