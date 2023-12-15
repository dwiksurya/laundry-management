<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $order = Order::whereOrderCode($request->order_code)
                ->first();

        $trackingProgress = [];
        if ($order) {
            $trackingProgress = [
                'process' => in_array($order->order_status, ['process', 'ready', 'taken']),
                'ready' => in_array($order->order_status, ['ready', 'taken']),
                'taken' => in_array($order->order_status, ['taken'])
            ];
        }

        return view('tracking.index', compact('order', 'trackingProgress'));
    }
}
