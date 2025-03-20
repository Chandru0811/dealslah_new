@extends('layouts.master')

@section('content')
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
    @if (session('status1'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var orderSuccessModal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
                orderSuccessModal.show();
            });
        </script>
        <div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3" style="border-radius: 24px !important">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-1 d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/images/home/check.webp') }}" class="img-fluid card-img-top1" />
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-1">
                            <p style="font-size: 20px">{{ session('status1')['order'] ?? '' }}</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <p style="font-size: 20px">{{ session('status1')['delivery'] ?? '' }}</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center text-center">
                            <p style="font-size: 18px; color: rgb(179, 184, 184)">
                                {{ session('status1')['address'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
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
                <button class="toast-close-btn"data-bs-dismiss="alert" aria-label="Close">
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
                <button class="toast-close-btn"data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa-solid fa-xmark" style="color: #EF4444"></i>
                </button>
            </div>
        </div>
    @endif
    <!-- Category & Banner Start  -->
    <!-- hero section -->
    <section class="categoryIcons">
        @include('contents.home.categoryGroup')
        @include('contents.home.slider')
    </section>



    <!--  Category & Banner End  -->

    <div class="products-container">
        <div id="products-wrapper">
            <section>
                {{-- @include('contents.home.hotpicks') --}}
                @include('contents.home.subCategory')
                <div class="container">
                    <h3 class="pt-0 pb-2 h3-styling">Products</h3>
                </div>
                @include('contents.home.products')
            </section>
        </div>

        <!-- Loading spinner -->
        <div class="loading-spinner loading-text d-none text-center" style="width: fit-content">
            <span style="color: #ef4444">Loading...</span>
        </div>
    </div>
    <!-- Product Card End -->

    <!-- App & PlayStore Start  -->
    @include('contents.home.playstoreContent')
    <!-- App & PlayStore End  -->

    <!-- Lead Magnet Model -->
    <div class="modal fade" id="indexLeadMagnetModal" tabindex="-1" role="dialog"
        aria-labelledby="indexLeadMagnetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="width: 380px;" role="document">
            <div class="modal-content modalContent" style="background-color: #1e1e1e">
                <div class="modal-body p-0 text-center position-relative">
                    <div type="button" class="position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-circle-xmark" style="color: #000; font-size: 20px"></i>
                    </div>
                    <a href="https://dealslah.com/categories/laptops_and_computers?dmbk=null">
                        <img src="{{ asset('assets/images/Ramadan Sales Gaming Laptops offers.webp') }}"
                            alt="Ramadan Sales Gaming Laptops offers" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
