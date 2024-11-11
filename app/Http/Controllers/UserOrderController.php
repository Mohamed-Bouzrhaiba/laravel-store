<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index(){
        $orders = Order::where("user_id",Auth::id())
       ->orderBy("created_at","desc")->paginate(10);
       //dd($orders);
       return view("order.index",compact("orders"));
    }

    public function showOrder($id){
        $order = Order::where("user_id",Auth::id())
        ->where("id",$id)
        ->with("orderDetails")->firstOrFail();
       // dd($order);
        return view("order.show",compact("order"));
    }
}
