@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order </h1>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">buyer</th>
            <th scope="col">addresse</th>
            <th scope="col">total amount</th>
            <th scope="col">details</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)
            <tr>

            <th scope="row">{{$order->id}}</th>
            <td>{{$order->user->name}}</td>
            <td>{{$order->address->address_line1}},{{$order->address->address_line1}},{{$order->address->city}}, {{$order->address->country}}</td>
            <td>{{$order->payment_method}}</td>
            <td>${{$order->total_amount}}</td>

            <td>
                <a class="btn btn-primary" href="{{route("orders.show",$order)}}">Show Detail</a>
            </td>
          </tr>@endforeach

        </tbody>
      </table>
@endsection
