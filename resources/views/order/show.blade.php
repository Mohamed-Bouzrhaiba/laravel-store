@extends('layouts.app')

@section('content')
    <x-header/>
    @include("admin.partials.flashbags")
<div class="container">


    <h1>Order #{{ $order->id }} Details</h1>

    <table class="table table-bordered">
        <tr>
            <th>Payment Method</th>
            <td><strong>{{ $order->payment_method }}</strong></td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
        </tr>
    </table>

    <!-- Order Items Table -->
    <h3>Order Items:</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name </th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ number_format($detail->price, 2) }}</td>
                    <td>${{ number_format($detail->quantity * $detail->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
