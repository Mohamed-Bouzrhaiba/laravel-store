@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Category</h1>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<form action="{{route("categories.store")}}" method="post" >
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">category name</label>
        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
<button class="btn btn-primary">Add</button>
</form>
@endsection
