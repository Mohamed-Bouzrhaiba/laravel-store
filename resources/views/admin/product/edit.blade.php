@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">edit poduct</h1>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<form action="{{route("products.update",$product->id)}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method("put")
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">product name</label>
        <input type="text" value="{{$product->name}}" name="name" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$product->description}}</textarea>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"> product image</label>
        <img  height="200px" width="200px" src="{{asset('storage/'.$product->image)}}" alt="">
        <input type="file" name="image" class="form-control"  >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">product price</label>
        <input type="number" value="{{$product->price}}" name="price" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">product quantity in stock</label>
        <input type="number" value="{{$product->stock_quantity}}" name="stock_quantity" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Select Category</label>
        <br>
    <select name="category_id" >
        <option value="{{$product->category_id}}" > {{$product->category->name}}</option>

        @foreach (App\Models\Category::all() as $category )
        <option value="{{$category->id}}" > {{$category->name}}</option>

        @endforeach

    </select>
    </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Select Brand</label>
            <br>
        <select name="brand_id" >
            <option value="{{$product->brand_id}}" > {{$product->brand->name}}</option>

            @foreach (App\Models\Brand::all() as $brand )
            <option value="{{$brand->id}}" > {{$brand->name}}</option>

            @endforeach
        </select>
        </div>


<button class="btn btn-primary">edit</button>
</form>
@endsection
