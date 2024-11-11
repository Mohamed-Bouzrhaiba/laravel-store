@extends('layouts.app')

@section('content')
<x-header/>
@include("admin.partials.flashbags")
<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>

    <!-- Address Selection -->
    <div class="card p-4 mb-4">
        <h4>Select Shipping Address</h4>
        <form action="{{ route('processOrder') }}" method="POST" id="checkout-form">
            @csrf
            <!-- Existing Address Dropdown -->
            <div class="form-group" id="address-select-container">
                <label for="address">Choose an address</label>
                <select name="addresse_id" id="address" class="form-control" required>
                    @if($addresses && $addresses->isNotEmpty())
                    <option value="" disabled selected> select your address</option>

                        @foreach($addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->address_line1 }}, {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}, {{ $address->country }}
                            </option>
                        @endforeach
                    @else
                        <option disabled>No saved addresses available</option>
                    @endif
                </select>
            </div>

            <!-- Button to Toggle New Address Form -->
            <a href="#" id="toggle-new-address-form" class="text-primary mt-2 d-block">+ Add New Address</a>

            <!-- Payment Method -->
            <h4 class="mt-4">Payment Method</h4>
            <div class="form-check">
                <input type="radio" name="payment_method" value="cash" id="payment_cash" class="form-check-input" checked required>
                <label for="payment_cash" class="form-check-label">Cash on Delivery</label>
            </div>
            <div class="form-check">
                <input type="radio" name="payment_method" value="paypal" id="payment_paypal" class="form-check-input" required>
                <label for="payment_paypal" class="form-check-label">PayPal</label>
            </div>

            <!-- Place Order Button -->
            <button type="submit" class="btn btn-primary mt-4" id="place-order-btn">Place Order</button>
        </form>

        <!-- PayPal Button (Hidden by Default) -->
        <form action="{{ route('paypal') }}" method="POST" id="paypal-form" style="display: none;">
            @csrf
            <input type="hidden" name="addresse_id" id="paypal-addresse-id" >

            <button type="submit" class="btn btn-primary mt-4">Pay with PayPal</button>
        </form>
    </div>

    <!-- New Address Form (Initially Hidden) -->
 <!-- New Address Form (Initially Hidden) -->
 <form action="{{ route('addresse.add') }}" method="POST" id="new-address-form" style="display: none;">
    @csrf
    <div class="card p-4 mt-4">
        <h4>Add New Address</h4>

        <!-- Address Line 1 -->
        <div class="form-group">
            <label for="address_line1">Street Address</label>
            <input type="text" id="address_line1" name="address_line1" class="form-control" required>
        </div>

        <!-- Address Line 2 -->
        <div class="form-group">
            <label for="address_line2">Address Line 2 (optional)</label>
            <input type="text" id="address_line2" name="address_line2" class="form-control">
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" class="form-control" required>
        </div>

        <!-- State -->
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" id="state" name="state" class="form-control" required>
        </div>

        <!-- ZIP Code -->
        <div class="form-group">
            <label for="postal_code">ZIP Code</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control" required>
        </div>

        <!-- Country -->
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Add New Address</button>
    </div>
</form>
</div>

<script>
    // Toggle New Address Form
    document.getElementById('toggle-new-address-form').addEventListener('click', function(event) {
        event.preventDefault();
        const addressSelectContainer = document.getElementById('address-select-container');
        const newAddressForm = document.getElementById('new-address-form');
        newAddressForm.style.display = newAddressForm.style.display === 'none' ? 'block' : 'none';
        addressSelectContainer.style.display = addressSelectContainer.style.display === 'none' ? 'block' : 'none';
        this.textContent = newAddressForm.style.display === 'none' ? "+ Add New Address" : "- Back to Select Address";
    });

    // Toggle Place Order and PayPal Button based on Payment Method
    document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            const placeOrderBtn = document.getElementById('place-order-btn');
            const paypalForm = document.getElementById('paypal-form');

            if (this.value === 'paypal') {
                placeOrderBtn.style.display = 'none';
                paypalForm.style.display = 'block';
            } else {
                placeOrderBtn.style.display = 'block';
                paypalForm.style.display = 'none';
            }
        });
    });
    document.getElementById('address').addEventListener('change', function() {
    const selectedAddressId = this.value;
    document.getElementById('paypal-addresse-id').value = selectedAddressId;
        });
</script>
@endsection
