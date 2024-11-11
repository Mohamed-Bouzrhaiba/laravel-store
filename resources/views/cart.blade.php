@extends("layouts.app")
@section("content")
<x-header/>
<div class="container">
    @include("admin.partials.flashbags")
    @if($CartItems->isEmpty())
    <div class="mt-3">
        <x-alert type="info">Your Cart is empty </x-alert>
    </div>
    @else
    <h1 class="display-6 mt-2">Your Cart:</h1>
    <table class="table mt-5">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product name</th>
            <th scope="col">quantity</th>
            <th scope="col">price</th>
            <th scope="col">total</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($CartItems as $item)
          <tr id="cart-item-{{ $item->id }}">
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->product->name }}</td>
            <td>
                <button class="btn btn-outline-secondary btn-sm mx-1 decrease-quantity" data-item-id="{{ $item->id }}">-</button>
                <span id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                <button  class="btn btn-outline-secondary btn-sm mx-1 increase-quantity" data-item-id="{{ $item->id }}">+</button>
            </td>
            <td id="price-{{ $item->id }}">{{ $item->price }}$</td>
            <td id="total-{{ $item->id }}">{{ $item->price * $item->quantity }}$</td>
            <td>
                <form action="{{ route('cart.clear.item', $item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Do you want to delete this product from cart?')" class="btn btn-danger" type="submit">X</button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
    @if (Auth::user()->cartItems->count() > 0)
    <a href="{{ route('checkout') }}" class="btn btn-success">Go To Checkout</a>
    @endif
</div>

<script>
    $(document).ready(function () {
        // increasing quantity
        $(".increase-quantity").click(function () {
            var itemId = $(this).data('item-id');
            var currentQuantity = parseInt($("#quantity-" + itemId).text());
            var newQuantity = currentQuantity + 1;
            updateQuantity(itemId, newQuantity);
        });

        //  decreasing quantity
        $(".decrease-quantity").click(function () {
            var itemId = $(this).data('item-id');
            var currentQuantity = parseInt($("#quantity-" + itemId).text());
            if (currentQuantity > 1) {
                var newQuantity = currentQuantity - 1;
                updateQuantity(itemId, newQuantity);
            }
        });

        // Update the quantity and total price
        function updateQuantity(itemId, newQuantity) {
            $.ajax({
                url: "{{ route('cart.update') }}", // Add your route for updating cart
                type: "POST",
                data: {
                    item_id: itemId,
                    quantity: newQuantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Update the quantity and price in the view
                        $("#quantity-" + itemId).text(newQuantity);
                        $("#total-" + itemId).text(response.newTotal + '$');
                    }
                },
                error: function() {
                    alert('An error occurred while updating the quantity.');
                }
            });
        }
    });
    </script>
@endsection
