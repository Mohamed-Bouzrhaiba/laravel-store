<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware("admin");
    }

    public function index(){
        $orders = Order::all();
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view("admin.dashboard",compact("orders","products","categories","brands"));
    }
    public function createProduct(){
        return view("admin.product.create");
    }
}
