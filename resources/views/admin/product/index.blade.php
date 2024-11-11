@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Management</h1>
                    <a class="btn btn-primary" href="{{route("products.create")}}">Add New Product</a>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">description</th>
            <th scope="col">price</th>
            <th scope="col">stock</th>
            <th scope="col">image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product )


          <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->name}}</td>
            <td>{{Str::limit($product->description, 100, '...') }}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->stock_quantity}}</td>
            <td><img src="{{asset('storage/'.$product->image)}}" alt="" srcset="" height="80px" width="80px"></td>
            @can('update', $product)
            <td> <a href="{{route("products.edit",$product->id)}}" class="btn btn-warning">Edit</a>
            @endcan

            @can('delete',$product)

            <form action="{{route("products.destroy",$product->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button onclick="return confirm('are u sure you want to delete this product')" class="btn btn-danger">delete</button>
            </form>
            @endcan

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$products->links()}}
@endsection

