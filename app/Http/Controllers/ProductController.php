<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware("admin");
    }
    public function index(){
        $products = Product::latest()->paginate(10);
        return view("admin.product.index",compact("products"));
    }
    public function create(){
        return view("admin.product.create");
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>'required|max:200',
            'description'=>'required|min:20|max:1000',
            'price'=>'required|numeric',
            'image'=>'required|mimes:png,jpg,jpeg',
            'stock_quantity'=>'required|numeric',
            'category_id'=>'required',
            'brand_id'=>'required'

        ]);
        $formFields['user_id'] = Auth::id();
        //dd($formFields);
        if($request->hasFile('image') ){
            $formFields['image']= $request->file('image')->store('products','public');
        }
         Product::create( $formFields );
        return to_route("products.index")->with("success","product added..!");
    }
    public function edit(Product $product){
        Gate::authorize('update',$product);
    return view("admin.product.edit",compact("product"));
    }
    public function update(Request $request,Product $product){
        $formFields = $request->validate([
            'name'=>'required|max:200',
            'description'=>'required|min:20|max:1000',
            'price'=>'required|numeric',
            'image'=>'mimes:png,jpg,jpeg',
            'stock_quantity'=>'required|numeric',
            'category_id'=>'required',
            'brand_id'=>'required'

        ]);
        if($request->hasFile('image') ){
            $formFields['image']= $request->file('image')->store('products','public');
        }
        $product->fill( $formFields )->save();
        return to_route("products.index")->with("success","updated!");
    }
    public function destroy(Product $product){
        Gate::authorize('delete',$product);
        $product->delete();
        return to_route("products.index")->with("success","product deleted..!");
    }
}
