@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New poduct</h1>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<form action="{{route("products.store")}}" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">product name</label>
        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"> product image</label>
        <input type="file" name="image" class="form-control"  >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">product price</label>
        <input type="number" name="price" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">product quantity in stock</label>
        <input type="number" name="stock_quantity" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Select Category</label>
        <br>
    <select name="category_id" >
        @foreach (App\Models\Category::all() as $category )
        <option value="{{$category->id}}" > {{$category->name}}</option>
        @endforeach

    </select>
    </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Select Brand</label>
            <br>
        <select name="brand_id" >
            @foreach (App\Models\Brand::all() as $brand )
            <option value="{{$brand->id}}" > {{$brand->name}}</option>
            @endforeach
        </select>
        </div>


<button class="btn btn-primary">Add</button>
</form>
@endsection
