@extends('layouts.app')
<x-header/>
@section('content')
    <div class="container">
        @include("admin.partials.flashbags")
        <h1 class="display-6 mt-2">Your Orders:</h1>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">date</th>
                <th scope="col">payment method</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Details</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders  as $order )
              <tr>
                <th scope="row">{{$order->id}}</th>
                <th scope="row">{{$order->created_at}}</th>
                <th>{{$order->payment_method}}</th>
                <th>{{$order->total_amount}}</th>
                <td> <a class="btn btn-primary" href="{{route("showOrderDetails",$order->id)}}">Show Details</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$orders->links()}}
    </div>

@endsection
