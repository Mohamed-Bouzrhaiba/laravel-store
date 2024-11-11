@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">category Management</h1>
                    <a class="btn btn-primary" href="{{route("categories.create")}}">Add New Product</a>
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
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category )


          <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>

            <td>@can('update',$category)


                <a href="{{route("categories.edit",$category->id)}}" class="btn btn-warning">Edit</a>
                @endcan
                @can('delete',$category)


                <form action="{{route("categories.destroy",$category->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('are u sure you want to delete this category')" class="btn btn-danger">delete</button>
                </form>
                @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$categories->links()}}
@endsection

