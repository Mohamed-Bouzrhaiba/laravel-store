@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">brands Management</h1>
                    <a class="btn btn-primary" href="{{route("brands.create")}}">Add New Brand</a>
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
            @foreach ($brands as $brand )


          <tr>
            <th scope="row">{{$brand->id}}</th>
            <td>{{$brand->name}}</td>
            <td>{{$brand->description}}</td>

            <td>
                @can('update',$brand)

                <a href="{{route("brands.edit",$brand->id)}}" class="btn btn-warning">Edit</a>
                @endcan

                @can('delete',$brand)


                <form action="{{route("brands.destroy",$brand->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('are u sure you want to delete this brand from the store')" class="btn btn-danger">delete</button>
                </form>
                @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$brands->links()}}
@endsection

