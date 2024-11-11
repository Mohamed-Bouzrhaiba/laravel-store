<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware("admin");
    }
    public function index(){
        $brands = Brand::latest()->paginate(10);
        return view("admin.brand.index",compact("brands"));
    }
    public function create(){
        return view("admin.brand.create");
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>"required|max:60",
            'description'=>"required|min:20"
        ]);
        $formFields['user_id']= Auth::id();
//dd($formFields);
        Brand::create($formFields);
        return to_route("brands.index")->with("success","added..!");
    }
    public function edit(Brand $brand){
        Gate::authorize("update",$brand);
        return view("admin.brand.edit",compact("brand"));
    }
    public function show(Brand $brand){

    }
    public function update(Request $request, Brand $brand){
        $formfields = $request->validate([
            'name'=>"required|max:60",
            "description"=> "required|max:1000"]);
            $brand->fill($formfields)->save();
            return to_route("brands.index")->with("success","updated");
        }

        public function destroy(Brand $brand){
        Gate::authorize("delete",$brand);
        $brand->delete();
        return to_route("brands.index")->with("success","Brand Deleted..!");
        }


}
