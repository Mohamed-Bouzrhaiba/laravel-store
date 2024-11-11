@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order # {{$order->id}} Details </h1>
                    <h1 class="m-0">Total Amount :${{$order->total_amount}} </h1>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product name</th>
            <th scope="col">quantity</th>
            <th scope="col">price</th>
            <th scope="col">total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $item)
                <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->quantity * $item->price}}</td>
                </tr>
            @endforeach

        </tbody>
      </table>
@endsection
