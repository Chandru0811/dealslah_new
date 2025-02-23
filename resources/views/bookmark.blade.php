@extends('layouts.master')

@section('content')
@php
   function formatIndianCurrency($num) {
    $num = intval($num);
    $lastThree = substr($num, -3);
    $rest = substr($num, 0, -3);
    if ($rest != '') {
        $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest) . ',';
    }
    return "₹" . $rest . $lastThree;
}

@endphp

    @if (session('status'))
        <div class="alert alert-dismissible fade show toast-success" role="alert"
            style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
            <div class="toast-content">
                <div class="toast-icon">
                    <i class="fa-solid fa-check-circle" style="color: #16A34A"></i>
                </div>
                <span class="toast-text"> {!! nl2br(e(session('status'))) !!}</span>&nbsp;&nbsp;
                <button class="toast-close-btn"data-bs-dismiss="alert" aria-label="Close">
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
    <section>
        <div class="container" style="margin-top: 100px">
            @if (isset($bookmarks) && $bookmarks->isNotEmpty())
                <!-- Display "Your Bookmark" heading only if there are bookmarks -->
                @if ($bookmarks->total() > 0)
                    <span class="d-flex">
                        <h5 class="pt-0 pb-2">Your Bookmarks</h5>
                        &nbsp;&nbsp;
                        <p class="d-flex" style="color: #ef4444;" id="bookmarkCountDisplay">
                            (<span class="totalItemsCount">{{ $bookmarks->total() }}</span>)
                        </p>
                    </span>
                @endif

                <div class="row pb-4">
                    @foreach ($bookmarks as $bookmark)
                        @php
                            $deal = $bookmark->deal;
                        @endphp
                        <div class="col-md-4 col-lg-3 col-12 mb-3 d-flex align-items-stretch justify-content-center">
                            <!-- Click event on this wrapper div instead of <a> tag -->
                            <div class="clickable-card" data-deal-id="{{ $deal->id }}">
                                <a href="{{ url('/deal/' . $deal->id) }}" style="text-decoration: none;">
                                    <div class="card sub_topCard h-100 d-flex flex-column">
                                        <div style="min-height: 50px">
                                            <span class="badge trending-badge">TRENDING</span>
                                            @php
                                                $image = isset($deal->productMedia)
                                                    ? $deal->productMedia
                                                        ->where('order', 1)
                                                        ->where('type', 'image')
                                                        ->first()
                                                    : null;
                                            @endphp
                                            <img src="{{ $image ? asset($image->resize_path) : asset('assets/images/home/noImage.webp') }}"
                                                class="img-fluid card-img-top1" alt="{{ $deal->name }}" />
                                        </div>
                                        <div
                                            class="card-body card_section flex-grow-1 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="mt-3 d-flex align-items-center justify-content-between">
                                                    <h5 class="card-title ps-3">{{ $deal->name }}</h5>
                                                    <span class="badge mx-3 p-0 trending-bookmark-badge"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Bookmark">
                                                        <button type="button" data-deal-id="{{ $deal->id }}"
                                                            class="bookmark-button" style="border: none; background: none;">
                                                            @if (count($deal->bookmark) === 0)
                                                                <i class="fa-regular fa-heart" style="color: #ef4444;"></i>
                                                            @else
                                                                <i class="fa-solid fa-heart" style="color: #ef4444;"></i>
                                                            @endif
                                                        </button>
                                                    </span>
                                                </div>
                                                <span class="px-3">
                                                    @php
                                                        $fullStars = floor($deal->shop->shop_ratings);
                                                        $hasHalfStar = $deal->shop->shop_ratings - $fullStars >= 0.5;
                                                        $remaining = 5 - ($hasHalfStar ? $fullStars + 1 : $fullStars);
                                                    @endphp
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fa-solid fa-star" style="color: #ffc200;"></i>
                                                    @endfor
                                                    @if ($hasHalfStar)
                                                        <i class="fa-solid fa-star-half-stroke" style="color: #ffc200;"></i>
                                                    @endif
                                                    @for ($i = 0; $i < $remaining; $i++)
                                                        <i class="fa-regular fa-star" style="color: #ffc200;"></i>
                                                    @endfor
                                                </span>
                                                <p class="px-3 fw-normal truncated-description">{{ $deal->description }}</p>
                                            </div>
                                            <div>
                                                <div class="card-divider"></div>
                                                <p class="ps-3 fw-medium d-flex align-items-center justify-content-between"
                                                    style="color: #ef4444">
                                                    <span>{{ formatIndianCurrency($deal->discounted_price) }}</span>
                                                    @if (!empty($deal->coupon_code))
                                                        <span id="mySpan" class="mx-3 px-2 couponBadge"
                                                            onclick="copySpanText(this, event)" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="Click to Copy"
                                                            style="position:relative;">

                                                            {{ $deal->coupon_code }}

                                                            <!-- Tooltip container -->
                                                            <span class="tooltip-text"
                                                                style="visibility: hidden; background-color: black; color: #fff; text-align: center;
                                                    border-radius: 6px; padding: 5px; position: absolute; z-index: 1;
                                                    bottom: 125%; left: 50%; margin-left: -60px;">
                                                                Copied!
                                                            </span>
                                                        </span>
                                                    @endif
                                                </p>
                                                <div class="card-divider"></div>
                                                <div class="ps-3 d-flex justify-content-between align-items-center pe-2">
                                                    <div>
                                                        <p>Regular Price</p>
                                                        @if ($deal->deal_type == 2)
                                                            <span style="color: #22cb00ab !important">Standard Rates</span>
                                                        @else
                                                            <span><s>{{ formatIndianCurrency($deal->original_price) }}</s></span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <button class="btn card_cart add-to-cart-btn"
                                                            data-slug="{{ $deal->slug }}"
                                                            onclick="event.stopPropagation();">
                                                            Add to Cart
                                                        </button>&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="card-divider"></div>
                                                <p class="ps-3 fw-medium"
                                                    style="color: #ef4444; font-weight: 400 !important;">
                                                    <i class="fa-solid fa-location-dot"></i>&nbsp;{{ $deal->shop->country }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty bookmark section -->
                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center"
                    style="min-height: 60vh">
                    <img src="{{ asset('assets/images/home/empty_bookmark.webp') }}" alt="Empty Bookmark"
                        class="img-fluid">
                    <h2 class="mt-5 mb-3" style="color: #ef4444">Your Bookmarks is waiting to be filled with treasures!
                    </h2>
                </div>
            @endif
            <div class="pagination justify-content-center">
                {{ $bookmarks->links() }}
            </div>
        </div>
    </section>

    <!-- Order placed-->
    {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderSuccessModal">
        Order Popup
    </button>

    <div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered shadow">
            <div class="modal-content p-3" style="border-radius: 24px !important">
                <div class="modal-body">
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="mb-1">
                        <img src="{{ asset('assets/images/home/check.webp') }}" class="img-fluid card-img-top1" />
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-1">
                        <p style="font-size: 20px">Order Placed Successfully !</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <p style="font-size: 20px">Delivering to</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <p style="font-size: 20px;color: rgb(179, 184, 184)">12B, Cloud Colony, Alwarpet, Chennai</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function updateBookmarkCount(count) {
                console.log(count)
                const countDisplay = $(".totalItemsCount");
                if (count > 0) {
                    countDisplay.text(count);
                    $("#bookmarkCountDisplay").css("display", "inline");
                    $(".totalItemsCount").css({
                        visibility: "visible",
                        display: "block",
                    });
                } else {
                    countDisplay.text("");
                    $("#bookmarkCountDisplay").css("display", "none");
                    $(".totalItemsCount").css({
                        visibility: "hidden",
                        display: "none",
                    });
                }
            }

            $(document).on('click', '.bookmark-button', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevents click from bubbling up

                let button = $(this);
                let dealId = button.data('deal-id');
                let isBookmarked = button.find('i').hasClass('fa-solid');

                if (isBookmarked) {
                    $.ajax({
                        url: `/bookmark/${dealId}/remove`,
                        method: 'DELETE',
                        success: function(response) {
                            updateBookmarkCount(response.total_items);

                            button.closest('.col-md-4').remove();

                            if (response.total_items == 0) {
                                let emptyBookmarkHtml = `
                                <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 60vh">
                                    <img src="{{ asset('assets/images/home/empty_bookmark.webp') }}" alt="Empty Bookmark" class="img-fluid">
                                    <h2 class="mt-5" style="color: #ef4444">Your bookmark is waiting to be filled with treasures!</h2>
                                </div>
                            `;
                                $('.row.pb-4').html(emptyBookmarkHtml);
                                $("#bookmarkCountDisplay").remove();
                                $("h5:contains('Your Bookmark')").parent()
                                    .remove(); // Remove heading if no bookmarks
                            }
                        },
                        error: function(xhr) {
                            console.error('Error occurred while removing bookmark:', xhr);
                        }
                    });
                }
            });

            $(document).on('click', '.clickable-card', function(e) {
                if (!$(e.target).closest('.bookmark-button').length) {
                    let dealId = $(this).data('deal-id');
                    clickCount(dealId); // Trigger click count only if not clicking the bookmark
                }
            });

            function loadBookmarkCount() {
                $.ajax({
                    url: '/totalbookmark',
                    method: 'GET',
                    success: function(response) {
                        updateBookmarkCount(response.total_items);
                    },
                    error: function(xhr) {
                        console.error('Failed to load bookmark count.');
                    }
                });
            }

            loadBookmarkCount();
            $('.bookmark-button [data-bs-toggle="tooltip"]').removeAttr("data-bs-toggle");
        });
    </script>
@endsection
