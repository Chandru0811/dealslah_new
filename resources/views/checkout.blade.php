@extends('layouts.master')

@section('content')
<section>
    <div class="container" style="margin-top: 100px;">
        <h2 class="text-center">Checkout</h2>
        <form id="checkoutForm">
            <div class="row my-5">
                <div class="col-md-7 col-12">
                    <div class="card p-3">
                        <div>
                            <div class="row">
                                <h5 class="mb-4" style="color: #ff0060;">Customer Info</h5>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobileNumber" id="mobileNumber" required />
                                </div>
                            </div>
                            <div class="row">
                                <h5 class="py-3" style="color: #ff0060;">Billing Address</h5>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Street</label>
                                    <input type="text" class="form-control" name="address" id="address" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label"></label>City
                                    <input type="text" class="form-control" name="city" id="city" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" id="state" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" required />
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" name="zipCode" id="zipCode" required />
                                </div>
                                <div class="col-13 mb-3">
                                    <input type="checkbox" class="form-check-input me-2">
                                    <label class="form-label">Same as Shipping Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5 style="color: #ff0060;">Payment Methods</h5>
                            <div class="row justify-content-center py-3">
                                <div class="col-lg-5 col-10 mb-3">
                                    <div class="card payment-option" onclick="selectPaymentOption('cash_on_delivery')">
                                        <div class="d-flex align-items-center p-3 w-100">
                                            <input type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" class="form-check-input">
                                            <label for="cash_on_delivery" class="d-flex align-items-center m-0">
                                                <img src="{{ asset('assets/images/home/cash_payment.png') }}" alt="Cash on Delivery" class="mx-3" style="width: 24px; height: auto;">
                                                <span>Cash on Delivery</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-10">
                                    <div class="card payment-option" onclick="selectPaymentOption('online_payment')">
                                        <div class="d-flex align-items-center p-3 w-100">
                                            <input type="radio" name="payment_method" id="online_payment" value="online_payment" class="form-check-input">
                                            <label for="online_payment" class="d-flex align-items-center m-0">
                                                <img src="{{ asset('assets/images/home/online_banking.png') }}" alt="Online Payment" class="mx-3" style="width: 24px; height: auto;">
                                                <span>Online Payment</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <div class="card p-3">
                        <h5 style="color: #ff0060;">Product Info</h5>
                        <div>
                            <img src="{{ asset($product->image_url1) }}" alt="Product Name" class="img-fluid px-5 py-3">
                            <h5 class="text-center">{{ $product->name }}</h5>
                            <div class="d-flex justify-content-center align-items-center">
                                <p style="text-decoration: line-through; color: gray;">₹{{ $product->original_price }}</p>&nbsp;&nbsp;
                                <p style="color: #ff0060; font-size: 24px;">₹{{ $product->discounted_price }}</p>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p>Subtotal</p>
                                    <p>Discount</p>
                                    <p>Delivery</p>
                                </div>
                                <div>
                                    <p>₹{{ $product->discounted_price }}</p>
                                    <p>₹0.00</p>
                                    <p>₹0.00</p>
                                </div>
                            </div>
                            <hr class="mt-1" />
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Total</p>
                                <p class="mb-0" style="color: #ff0060; font-size: 24px;">₹{{ $product->discounted_price }}</p>
                            </div>
                            <p style="color: #b12704">Your Savings : ₹{{ number_format($product->original_price - $product->discounted_price, 2) }} ({{ number_format($product->discount_percentage, 0) }}%)</p>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" placeholder="Enter a coupon code" value="{{ $product->coupon_code }}">
                                <button class="btn applyBtn" type="button" id="button-addon2">Apply</button>
                            </div>
                            <button type="submit" class="btn applyBtn w-100">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection