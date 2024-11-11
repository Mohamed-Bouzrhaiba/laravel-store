<?php

namespace App\Http\Controllers;

use App\Models\Order;


class OrderController extends Controller
{
    public function index(){

            $orders = Order::with(['orderDetails'])->get();
            //dd($orders);
            return view('admin.orders.index', compact('orders'));
        }
    public function show(Order $order){
        $order = Order::where('id', $order->id)
        ->with(['orderDetails'])->first();
       // dd($order);
        return view('admin.orders.show', compact('order'));
    }

}
