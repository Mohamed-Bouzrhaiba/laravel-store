@extends('layouts.app')

@section('content')

<x-header/>
@include("admin.partials.flashbags")
<x-hero-section/>
<x-category-section/>
<div class="products-section">
    <h2 class="section-title">Our Products</h2>
    <div class="products-grid">
        @foreach ($products as $product)
        <a href="{{ route('product.show', $product->id) }}" class="product-card">
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">
            <div class="product-details">
                <h3 class="product-name">{{ $product->name }}</h3>
                <p class="product-price">${{ $product->price }}</p>
            </div>
        </a>
        @endforeach
    </div>
    {{ $products->links() }}
</div>


<div>

</div>

@endsection
