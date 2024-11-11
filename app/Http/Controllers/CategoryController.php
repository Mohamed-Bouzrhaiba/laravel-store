<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware("admin");
    }
    public function index(){
        $categories = Category::latest()->paginate(10);
        return view("admin.category.index",compact("categories"));
    }
    public function create(){
        return view("admin.category.create");
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>"required|max:60",
            'description'=>"required|min:20"
        ]);
        $formFields['user_id']= Auth::id();
        $category = Category::create($formFields);
        return to_route("categories.index")->with("success","added..!");
    }
    public function edit(Category $category){
        Gate::authorize("update",$category);

        return view("admin.category.edit",compact("category"));
    }
    public function update(Request $request, Category $category){
        $formfields = $request->validate([
            'name'=>"required|max:60",
            "description"=> "required|max:1000"]);
            $category->fill($formfields)->save();
            return to_route("categories.index")->with("success","updated");
        }

    public function destroy(Category $category){
        Gate::authorize("delete",$category);

        $category->delete();
        return to_route("categories.index")->with("success","category deleted..!");
    }
}
