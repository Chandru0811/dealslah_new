@extends('layouts.master')

@section('content')
@if ($orderoption == 'buynow')
<section>
    @if (session('status'))
    <div class="alert alert-dismissible fade show" role="alert"
        style="position: fixed; top: 70px; right: 40px; z-index: 1050; background:#00e888; color:#fff">
        {!! nl2br(e(session('status'))) !!}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-dismissible fade show" role="alert"
        style="position: fixed; top: 70px; right: 40px; z-index: 1050; background:#ff0060; color:#fff">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-dismissible fade show" role="alert"
        style="position: fixed; top: 70px; right: 40px; z-index: 1050; background:#ff0060; color:#fff">
        {{ session('error') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container" style="margin-top: 100px;">
        <!-- <h2 class="text-center">Checkout</h2> -->
        <form id="checkoutForm" action="{{ route('checkout.checkout') }}" method="POST">
            @csrf
            <!-- Hidden Fields -->
            <input type="hidden" name="cart_id" value="{{ $cart->id }}" id="cart_id">
            <input type="hidden" name="address_id" value="{{ $address->id }}" id="address_id">
            <input type="hidden" name="product_ids" value="{{ $product_ids }}" id="product_id">
            <div class="row my-5">
                <div class="col-12">

                    {{-- Saved Address --}}
                    <div class="card p-3 mb-3">
                        <h5 class="mb-4 p-0">Delivery Addresses</h5>

                        <div class="row">
                            <div class="col-md-12">
                                {{-- @php
                                            $orderAddress = $order ? json_decode($order->delivery_address, true) : [];
                                        @endphp --}}
                                <p style="color: #6C6C6C">
                                    {{ $address->first_name ?? '' }}
                                    {{ $address->last_name ?? '' }} (+91)
                                    {{ $address->phone ?? '' }}&nbsp;&nbsp;
                                    {{ $address->address ?? '' }},
                                    {{ $address->city ?? '' }},
                                    {{ $address->state ?? '' }}
                                    - {{ $address->postalcode ?? '' }}
                                    {{-- <span>
                                                <span class="badge badge_infos py-1" data-bs-toggle="modal"
                                                    data-bs-target="#myAddressModal">Change</span>
                                            </span> --}}
                                </p>
                            </div>
                        </div>
                    </div>


                    <!-- Order Summary -->
                    <div class="card p-3 mb-3">
                        <h5 class="mb-4" style="color:#ff0060;">Order Summary</h5>
                        @foreach ($cart->items as $item)
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>{{ $item->product->name }} x{{ $item->quantity }}</p>
                            </div>
                            <div>
                                <span style="text-decoration: line-through; color:#c7c7c7">
                                    ₹{{ number_format($item->product->original_price * $item->quantity, 0) }}
                                </span>
                                <span class="ms-1" style="font-size:22px;color:#ff0060">
                                    ₹{{ number_format($item->product->discounted_price * $item->quantity, 0) }}
                                </span>
                                <span class="ms-1" style="font-size:12px; color:#00DD21">
                                    ({{ number_format($item->product->discount_percentage, 0) }}%)
                                    off
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Payment Methods -->
                    <div class="card p-3 mb-3">
                        <div>
                            <h5 style="color:#ff0060;">Payment Methods</h5>
                            <div class="row justify-content-center mt-3">
                                <div class="col-lg-5 col-10 mb-3">
                                    <div class="card payment-option" onclick="selectPaymentOption('cash_on_delivery')">
                                        <div class="d-flex align-items-center p-3 w-100">
                                            <input type="radio" name="payment_type" id="cash_on_delivery"
                                                value="cash_on_delivery" class="form-check-input"
                                                {{ old('payment_type') == 'cash_on_delivery' ? 'checked' : '' }}>
                                            <label for="cash_on_delivery" class="d-flex align-items-center m-0">
                                                <img src="{{ asset('assets/images/home/cash_payment.png') }}"
                                                    alt="Cash on Delivery" class="mx-3"
                                                    style="width: 24px; height: auto;">
                                                <span>Cash on Delivery</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-10">
                                    <!-- <div class="card payment-option" onclick="selectPaymentOption('online_payment')">
                                        <div class="d-flex align-items-center p-3 w-100">
                                            <input type="radio" name="payment_type" id="online_payment"
                                                value="online_payment" class="form-check-input"
                                                {{ old('payment_type') == 'online_payment' ? 'checked' : '' }}>
                                            <label for="online_payment" class="d-flex align-items-center m-0">
                                                <img src="{{ asset('assets/images/home/online_banking.png') }}"
                                                    alt="Online Payment" class="mx-3"
                                                    style="width: 24px; height: auto;">
                                                <span>Online Payment</span>
                                            </label>
                                        </div>
                                    </div> -->
                                </div>
                                @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-3 mt-4"
                        style="position: sticky; bottom: 0px; background: #fff;border-top: 1px solid #dcdcdc">
                        <div class="d-flex justify-content-end align-items-center">
                            <h4>Total Amount &nbsp;&nbsp;
                                <span style="text-decoration: line-through; color:#c7c7c7" class="subtotal">
                                    ₹{{ number_format($cart->items->sum(fn($item) => $item->product->original_price * $item->quantity), 0) }}
                                </span>
                                &nbsp;&nbsp;
                                <span class="ms-1" style="color:#000">
                                    ₹{{ number_format($cart->items->sum(fn($item) => $item->product->discounted_price * $item->quantity), 0) }}
                                </span>
                                &nbsp;&nbsp;
                                <span class="total ms-1" style="font-size:12px; color:#00DD21;white-space: nowrap;">
                                    Dealsmachi Discount
                                    &nbsp;<span
                                        class="discount">₹{{ number_format($cart->items->sum(fn($item) => ($item->product->original_price - $item->product->discounted_price) * $item->quantity), 2) }}</span>
                                </span>
                            </h4>
                        </div>
                        <div class="d-flex justify-content-end align-items-center ">
                            <button type="submit" class="btn placeorder_btn">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
        </form>

    </div>
</section>
@else
<section>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
        {!! nl2br(e(session('status'))) !!}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
        style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
        style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
        {{ session('error') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container" style="margin-top: 100px;">
        <h2 class="text-center">Checkout</h2>
        <form id="checkoutForm" action="{{ route('checkout.checkout') }}" method="POST">
            @csrf
            <!-- Hidden Fields -->
            <input type="hidden" name="cart_id" value="{{ $cart->id }}" id="cart_id">
            <input type="hidden" name="address_id" value="{{ $address->id }}" id="address_id">
            <div class="row my-5">
                <div class="col-12">
                    <!-- Customer Info Section -->
                    <div class="card p-3 mb-3">
                        <div class="row">
                            <h5 class="mb-4" style="color:#ff0060;"> Delivery Address</h5>
                            <p>
                                <strong>{{ $address->first_name ?? '' }}
                                    {{ $address->last_name ?? '' }} (+91)
                                    {{ $address->phone ?? '' }}</strong>&nbsp;&nbsp;
                                {{ $address->address ?? '' }} - {{ $address->postalcode ?? '' }}
                                <span>
                                    @if ($address->default)
                                    <span class="badge badge_danger py-1">Default</span>&nbsp;&nbsp;
                                    @endif
                                    {{-- <span class="badge badge_infos py-1" data-bs-toggle="modal"
                                                    data-bs-target="#myAddressModal">Change</span> --}}
                                </span>
                            </p>

                        </div>
                    </div>
                    <!-- Order summary -->
                    <div class="card p-3 mb-3">
                        <div class="row">
                            <h5 class="mb-4" style="color:#ff0060;">Order Summary</h5>
                            @foreach ($cart->items as $item)
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p>{{ $item->product->name }} x{{ $item->quantity }}</p>
                                </div>
                                <div>
                                    <span style="text-decoration: line-through; color:#c7c7c7">
                                        ₹{{ number_format($item->product->original_price * $item->quantity, 0) }}
                                    </span>
                                    <span class="ms-1" style="font-size:22px;color:#ff0060">
                                        ₹{{ number_format($item->product->discounted_price * $item->quantity, 0) }}
                                    </span>
                                    <span class="ms-1" style="font-size:12px; color:#00DD21">
                                        ({{ number_format($item->product->discount_percentage, 0) }}%)
                                        off
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Payment Methods -->
                    <div class="card p-3 mb-3">
                        <div>
                            <h5 style="color:#ff0060;">Payment Methods</h5>
                            <div class="row justify-content-center mt-3">
                                <div class="col-lg-5 col-10 mb-3">
                                    <div class="card payment-option" onclick="selectPaymentOption('cash_on_delivery')">
                                        <div class="d-flex align-items-center p-3 w-100">
                                            <input type="radio" name="payment_type" id="cash_on_delivery"
                                                value="cash_on_delivery" class="form-check-input"
                                                {{ old('payment_type') == 'cash_on_delivery' ? 'checked' : '' }}>
                                            <label for="cash_on_delivery" class="d-flex align-items-center m-0">
                                                <img src="{{ asset('assets/images/home/cash_payment.png') }}"
                                                    alt="Cash on Delivery" class="mx-3"
                                                    style="width: 24px; height: auto;">
                                                <span>Cash on Delivery</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-10">
                                    <!-- <div class="card payment-option" onclick="selectPaymentOption('online_payment')">
                                        <div class="d-flex align-items-center p-3 w-100">
                                            <input type="radio" name="payment_type" id="online_payment"
                                                value="online_payment" class="form-check-input"
                                                {{ old('payment_type') == 'online_payment' ? 'checked' : '' }}>
                                            <label for="online_payment" class="d-flex align-items-center m-0">
                                                <img src="{{ asset('assets/images/home/online_banking.png') }}"
                                                    alt="Online Payment" class="mx-3"
                                                    style="width: 24px; height: auto;">
                                                <span>Online Payment</span>
                                            </label>
                                        </div>
                                    </div> -->
                                </div>
                                @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-3 mt-4"
                        style="position: sticky; bottom: 0px; background: #fff;border-top: 1px solid #dcdcdc">
                        <div class="d-flex justify-content-end align-items-center ">
                            <h4>Total Amount &nbsp;&nbsp; <span style="text-decoration: line-through; color:#c7c7c7"
                                    class="subtotal">
                                    ₹{{ number_format($cart->total, 0) }}
                                </span> &nbsp;&nbsp; <span class="total ms-1" style="color:#000">
                                    ₹{{ number_format($cart->grand_total, 0) }}
                                </span> &nbsp;&nbsp; <span class="ms-1"
                                    style="font-size:12px; color:#00DD21;white-space: nowrap;">
                                    Dealsmachi Discount
                                    &nbsp;<span class="discount">₹{{ number_format($cart->discount, 2) }}</span></span>
                            </h4>
                        </div>
                        {{-- <div class="d-flex justify-content-end align-items-center py-3"
                                    style="position:sticky; bottom:10px; background:#fff"> --}}
                        <button type="submit" class="btn placeorder_btn">
                            Place Order
                        </button>
                        {{-- </div> --}}
                    </div>
                </div>
        </form>
    </div>
</section>
@endif
@endsection
