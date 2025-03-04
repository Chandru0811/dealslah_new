@extends('layouts.master')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @if (session('status'))
        <div class="alert alert-dismissible fade show toast-success" role="alert"
            style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
            <div class="toast-content">
                <div class="toast-icon">
                    <i class="fa-solid fa-check-circle" style="color: #16A34A"></i>
                </div>
                <span class="toast-text"> {!! nl2br(e(session('status'))) !!}</span>&nbsp;&nbsp;
                <button class="toast-close-btn" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa-thin fa-xmark" style="color: #16A34A"></i>
                </button>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert  alert-dismissible fade show toast-danger" role="alert"
            style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
            <div class="toast-content">
                <div class="toast-icon">
                    <i class="fa-solid fa-triangle-exclamation" style="color: #EF4444"></i>
                </div>
                <span class="toast-text">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>&nbsp;&nbsp;
                <button class="toast-close-btn" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa-solid fa-xmark" style="color: #EF4444"></i>
                </button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="alert  alert-dismissible fade show toast-danger" role="alert"
            style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
            <div class="toast-content">
                <div class="toast-icon">
                    <i class="fa-solid fa-triangle-exclamation" style="color: #EF4444"></i>
                </div>
                <span class="toast-text">
                    {{ session('error') }}
                </span>&nbsp;&nbsp;
                <button class="toast-close-btn" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa-solid fa-xmark" style="color: #EF4444"></i>
                </button>
            </div>
        </div>
    @endif
    <section>
        <div class="container" style="margin-top: 100px">
            <h2 class="my-4">Buy Later</h2>
            @if ($savedItems->isEmpty())
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/images/home/empty_savedItems.png') }}" alt="Empty Cart"
                        class="img-fluid mb-2" style="width: 300px;" />
                    <h4 style="color: #ef4444;">Your Saved Wishlists are awaiting your selection!</h4>
                </div>
            @else
                <!-- Display saved items -->
                <div class="saved-items">
                    <hr>
                    @foreach ($savedItems as $savedItem)
                        <div class="saved-item" data-product-id="{{ $savedItem->deal->id }}">
                            <div class="row p-4">
                                <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        @php
                                            $image = isset($savedItem->deal->productMedia)
                                                ? $savedItem->deal->productMedia
                                                    ->where('order', 1)
                                                    ->where('type', 'image')
                                                    ->first()
                                                : null;
                                        @endphp
                                        <img src="{{ $image ? asset($image->resize_path) : asset('assets/images/home/noImage.webp') }}"
                                            style="max-width: 100%; max-height: 100%;" alt="{{ $savedItem->deal->name }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $currentDate = Carbon::now();

                                        $deliveryDays = is_numeric($savedItem->deal->delivery_days)
                                            ? (int) $savedItem->deal->delivery_days
                                            : 0;

                                        $deliveryDate =
                                            $deliveryDays > 0
                                                ? $currentDate->addDays($deliveryDays)->format('d-m-Y')
                                                : null;
                                    @endphp
                                    <h5>{{ $savedItem->deal->name }}</h5>
                                    <h6 class="truncated-description">{{ $savedItem->deal->description }}</h6>
                                    <p class="mb-1">Delivery Date :
                                        <span class="stars">
                                            <span>
                                                {{ $deliveryDays > 0 ? $deliveryDate : 'No delivery date available' }}
                                            </span>
                                        </span>
                                    </p>
                                    @if ($savedItem->deal->shop->show_name_on_website)
                                        <p>Seller Company Name : {{ $savedItem->deal->shop->legal_name }}</p>
                                    @endif
                                    <div>
                                        <span style="text-decoration: line-through; color:#c7c7c7">
                                            ${{ number_format($savedItem->deal->original_price, 2) }}
                                        </span>
                                        <span class="ms-1" style="font-size:22px;color:#ef4444">
                                            ${{ number_format($savedItem->deal->discounted_price, 2) }}
                                        </span>
                                        <span class="ms-1" style="font-size:12px; color:#00DD21">
                                            {{ round($savedItem->deal->discount_percentage) }}% off
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex flex-column justify-content-end align-items-end mb-3">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn border btn-outline-secondary saveLaterToCart"
                                            data-product-id="{{ $savedItem->deal->id }}"
                                            style="padding: 14px 20px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                                            Move to Cart
                                        </button>
                                        <button type="button" class="btn border btn-outline-secondary removeSaveLater"
                                            data-product-id="{{ $savedItem->deal->id }}"
                                            style="padding: 14px 20px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                <hr class="mt-3">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
