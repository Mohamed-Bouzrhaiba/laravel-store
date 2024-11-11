@extends('layouts.app')

@section('content')
<x-header/>

<div class="container my-5">
    @include("admin.partials.flashbags")
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid rounded" style="max-width: 100%; width: 300px; height: auto;">
        </div>
        <div class="col-md-6">
            <h1 class="display-5">{{ $product->name }}</h1>
            <p class="text-muted">Brand: {{ $product->brand->name }}</p>
            <p class="text-muted">Category: {{ $product->category->name }}</p>
            <p class="lead">{{ $product->description }}</p>
            <h3 class="display-6" style="color: #28a745;">Price: ${{ $product->price }}</h3>

            <form action="{{route("cart.add",$product->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">

                <button type="submit" class="btn btn-warning mt-3">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection
