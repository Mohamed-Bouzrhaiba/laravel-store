<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products= Product::latest()->paginate(9);
        return view('home',compact('products'));
    }
    public function productShow(Product $product){
    return view('product',compact('product'));
    }
}
