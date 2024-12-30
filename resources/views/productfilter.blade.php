@extends('layouts.master')

@section('content')
<div class="categoryIcons">
    @php
    $isCategory = !empty($category);
    $isHotpick = request()->is('hotpick/*');
    $isAll = request('slug') === 'all';
    @endphp
    <form
        method="GET"
        action="{{ 
            $isAll 
            ? route('deals.subcategorybased', ['slug' => 'all']) 
            : ($isCategory 
                ? route('deals.subcategorybased', ['slug' => $category->slug]) 
                : ($isHotpick 
                    ? route('deals.categorybased', ['slug' => request()->segment(2)]) 
                    : route('search')
                  )
              ) 
        }}"
        id="filterForm">
        @if($isAll)
        <input type="hidden" id="category_group_id" name="category_group_id" value="{{ request('category_group_id') }}">
        @endif
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <div class="p-4 topFilter">
            <div class="row d-flex align-items-center">
                <!-- Beauty Spa and Hair Section -->
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    @if (!empty($categorygroup) && !empty($category))
                    <div class="d-flex justify-content-start px-5">
                        <a href="/" class="text-decoration-none">
                            <p class="topText mb-0">{{ $categorygroup->name ?? '' }}
                                <i class="arrow-icon me-2 fa-solid fa-angle-right"></i>
                            </p>
                        </a>
                        <p class="selectText mb-0" style="cursor: default">{{ $category->name ?? '' }}</p>
                    </div>
                    @endif
                </div>

                <div class="col-12 col-md-4">
                    <div class="d-flex justify-content-md-end justify-content-center align-items-center">
                        <div class="d-flex align-items-center me-3">
                            <p class="mb-0 dropdownheading me-2">Per Page:</p>
                            <select class="form-select dropdownproduct" aria-label="Default select example"
                                name="per_page" onchange="this.form.submit()" style="color: #8A8FB9">
                                <option value="5" {{ request()->input('per_page') == 5 ? 'selected' : '' }}>5
                                </option>
                                <option value="10" {{ request()->input('per_page', 10) == 10 ? 'selected' : '' }}>10
                                </option>
                                <option value="15" {{ request()->input('per_page') == 15 ? 'selected' : '' }}>15
                                </option>
                                <option value="25" {{ request()->input('per_page') == 25 ? 'selected' : '' }}>25
                                </option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 dropdownheading me-2">Sort By:</p>
                            <select class="form-select dropdownproduct" aria-label="Default select example"
                                name="short_by" onchange="this.form.submit()" style="color: #8A8FB9">
                                <option value="" class="filterdropdown"></option>
                                @foreach ($shortby as $dealsoption)
                                <option value="{{ $dealsoption->slug }}" class="filterdropdown"
                                    {{ request()->input('short_by') == $dealsoption->slug ? 'selected' : '' }}>
                                    {{ $dealsoption->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Filter Button for Mobile -->
        <div class="col-2 d-lg-none filter-button d-flex justify-content-center align-items-center mb-3 mx-3 mt-2"
            style="width: fit-content !important">
            <button class="btn btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas"
                aria-controls="filterOffcanvas" style="border: none;width: fit-content !important">
                <i class="fa-solid fa-filter" style="color: #fff"></i> <span class="text-white ms-1">Filters</span>
            </button>
        </div>

        <!-- Filters Section -->
        <div class="row filterindSection m-0 mt-3">
            @if ($deals->isNotEmpty())
            {{-- Offcanvas for Mobile --}}
            <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas"
                aria-labelledby="filterOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="filterOffcanvasLabel">Filter Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="overflow-y: auto">
                    <div class="row">
                        <div class="col-6">
                            <p class="canvas_topText2">Filter Results</p>
                        </div>
                        <div class="col-6">
                            <p class="canvas_selectText2">{{ $totaldeals }} deals available</p>
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div class="px-5 pb-3">
                        <div class="d-flex flex-column">
                            <p class="topText3 mb-1" style="border-bottom: 1px solid black; width:fit-content">Brand
                            </p>
                        </div>
                        @foreach ($brands as $brand)
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="brand[]"
                                value="{{ $brand }}" id="brand_{{ $loop->index }}"
                                {{ in_array($brand, request()->input('brand', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="brand_{{ $loop->index }}">
                                {{ str_replace('_', ' ', $brand) }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Discount Filter -->
                    <div class="px-5 pb-3">
                        <div class="d-flex flex-column">
                            <p class="topText3">Discount Offer</p>
                            <div class="textline2"></div>
                        </div>
                        @foreach ($discounts as $discount)
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="discount[]"
                                value="{{ $discount }}" id="discount_{{ $loop->index }}"
                                {{ in_array($discount, request()->input('discount', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="discount_{{ $loop->index }}">
                                {{ number_format($discount, 0) }}%
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Rating Item Filter -->
                    <div class="px-5 pb-3">
                        <div class="d-flex flex-column">
                            <p class="topText3 mb-1">Rating Item</p>
                            <div class="textline2"></div>
                        </div>

                        @foreach ($rating_items as $item)
                        <div class="form-check d-flex align-items-center pt-3">
                            <input class="form-check-input yellow-checkbox me-2" type="checkbox"
                                name="rating_item[]" value="{{ $item->shop_ratings }}"
                                id="rating_{{ $loop->index }}"
                                {{ in_array($item->shop_ratings, request()->input('rating_item', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="rating_{{ $loop->index }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <=floor($item->shop_ratings))
                                    <i class="fa-solid fa-star" style="color: #FFC107"></i> <!-- Full star -->
                                    @elseif ($i == floor($item->shop_ratings) + 1 && ($item->shop_ratings - floor($item->shop_ratings)) >= 0.5)
                                    <i class="fa-solid fa-star-half-stroke" style="color: #FFC107"></i> <!-- Half star -->
                                    @else
                                    <i class="fa-regular fa-star" style="color: #FFC107"></i> <!-- Empty star -->
                                    @endif
                                    @endfor
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Price Filter -->
                    <div class="px-5 pb-4">
                        <div class="d-flex flex-column">
                            <p class="topText3 mb-1">Price Filter</p>
                            <div class="textline2"></div>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs0-Rs1000" id="price_0_1000"
                                {{ in_array('Rs0-Rs1000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_0_1000">
                                Under Rs 1000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs1000-Rs2000" id="price_1000_2000"
                                {{ in_array('Rs1000-Rs2000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_1000_2000">
                                Rs 1000 - Rs 2000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs2000-Rs5000" id="price_2000_5000"
                                {{ in_array('Rs2000-Rs5000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_2000_5000">
                                Rs 2000 - Rs 5000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs5000-Rs10000" id="price_5000_10000"
                                {{ in_array('Rs5000-Rs10000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_5000_10000">
                                Rs 5000 - Rs 10000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs10000-Rs100000" id="price_10000_100000"
                                {{ in_array('Rs10000-Rs100000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_10000_100000">
                                Above Rs 10000
                            </label>
                        </div>
                    </div>
                </div>
                <div class="px-5 sticky-bottom d-flex justify-content-center align-items-center mb-3">
                    <!-- Buttons inside your offcanvas -->
                    <button type="button" class="btn btn-button clear-button" id="clearButton">Clear
                        All</button>
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-button apply-button" id="applyButton">Apply</button>
                </div>
            </div>

            <!-- Filter Sidebar for Larger Screens -->
            @if (!$deals->isEmpty())
            <div class="col-md-3 col-12 d-none d-lg-block">
                <div class="productFilter filterlarge">
                    <div class="d-flex justify-content-center align-items-center pb-3">
                        <p class="me-2 topText2">Filter Results</p>
                        &nbsp;&nbsp;
                        <p class="selectText2">{{ $totaldeals }} deals available</p>
                    </div>

                    <!-- Brand Filter -->
                    <div class="px-5 pb-3">
                        <div class="d-flex flex-column">
                            <p class="topText3 mb-1"
                                style="border-bottom: 1px solid black; width:fit-content">
                                Brand</p>
                        </div>
                        @foreach ($brands as $brand)
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="brand[]"
                                value="{{ $brand }}" id="brand_large_{{ $loop->index }}"
                                {{ in_array($brand, request()->input('brand', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable"
                                for="brand_large_{{ $loop->index }}">
                                {{ str_replace('_', ' ', $brand) }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Discount Filter -->
                    <div class="px-5 pb-3">
                        <div class="d-flex flex-column">
                            <p class="topText3">Discount Offer</p>
                            <div class="textline2"></div>
                        </div>
                        @foreach ($discounts as $discount)
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="discount[]"
                                value="{{ $discount }}" id="discount_large_{{ $loop->index }}"
                                {{ in_array($discount, request()->input('discount', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable"
                                for="discount_large_{{ $loop->index }}">
                                {{ number_format($discount, 0) }}%
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Rating Item Filter -->
                    <div class="px-5 pb-3">
                        <div class="d-flex flex-column">
                            <p class="topText3 mb-1">Rating Item</p>
                            <div class="textline2"></div>
                        </div>

                        @foreach ($rating_items as $item)
                        <div class="form-check d-flex align-items-center pt-3">
                            <input class="form-check-input yellow-checkbox me-2" type="checkbox"
                                name="rating_item[]" value="{{ $item->shop_ratings }}"
                                id="rating_{{ $loop->index }}"
                                {{ in_array($item->shop_ratings, request()->input('rating_item', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="rating_{{ $loop->index }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <=floor($item->shop_ratings))
                                    <i class="fa-solid fa-star" style="color: #FFC107"></i> <!-- Full star -->
                                    @elseif ($i == floor($item->shop_ratings) + 1 && ($item->shop_ratings - floor($item->shop_ratings)) >= 0.5)
                                    <i class="fa-solid fa-star-half-stroke" style="color: #FFC107"></i> <!-- Half star -->
                                    @else
                                    <i class="fa-regular fa-star" style="color: #FFC107"></i> <!-- Empty star -->
                                    @endif
                                    @endfor
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Price Filter -->
                    <div class="px-5 pb-4">
                        <div class="d-flex flex-column">
                            <p class="topText3 mb-1">Price Filter</p>
                            <div class="textline2"></div>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs0-Rs1000" id="price_0_to_1000"
                                {{ in_array('Rs0-Rs1000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_0_to_1000">
                                Under Rs 1000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs1000-Rs2000" id="price_1000_to_2000"
                                {{ in_array('Rs1000-Rs2000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_1000_to_2000">
                                Rs 1000 - Rs 2000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs2000-Rs5000" id="price_2000_to_5000"
                                {{ in_array('Rs2000-Rs5000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_2000_to_5000">
                                Rs 2000 - Rs 5000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs5000-Rs10000" id="price_5000_to_10000"
                                {{ in_array('Rs5000-Rs10000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_5000_to_10000">
                                Rs 5000 - Rs 10000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="Rs10000-Rs100000" id="price_10000_to_100000"
                                {{ in_array('Rs10000-Rs100000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_10000_to_100000">
                                Above Rs 10000
                            </label>
                        </div>
                    </div>

                    <div class="px-5 sticky-bottom d-flex justify-content-center align-items-center mb-3">
                        <!-- Buttons for Large Screen -->
                        <button type="button" class="btn btn-button clear-button"
                            id="clearButtonLarge">Clear
                            All</button>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-button apply-button"
                            id="applyButtonLarge">Apply</button>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-12 col-lg-9 col-12">
                @if(request()->routeIs('deals.subcategorybased'))
                <div class="container mb-3 topbarContainer">
                    <div class="d-flex overflow-auto topBar">
                        <a href="{{ route('deals.subcategorybased', ['slug' => 'all', 'category_group_id' => $categorygroup->id]) }}"
                            class="btn me-2 {{ request('slug') === 'all' && request('category_group_id') == $categorygroup->id ? 'active' : '' }}">
                            All
                        </a>
                        @foreach ($categorygroup->categories as $cat)
                        <a href="{{ route('deals.subcategorybased', ['slug' => $cat->slug]) }}"
                            class="btn mx-2 {{ request('slug') === $cat->slug && request('slug') !== 'all' ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-lg-9 col-12">
                        <div class="row pb-4">
                            @foreach ($deals as $product)
                            <div
                                class="col-md-4 col-lg-6 col-xl-4 col-12 mb-3 d-flex justify-content-center align-items-stretch">
                                <a href="{{ url('/deal/' . $product->id) }}" style="text-decoration: none;"
                                    onclick="clickCount('{{ $product->id }}')">
                                    <div class="card sub_topCard h-100 d-flex flex-column">
                                        <div style="min-height: 50px">
                                            <span class="badge trending-badge">{{ $product->label }}</span>
                                            <img src="{{ asset($product->image_url1) }}"
                                                class="img-fluid card-img-top1" alt="card_image" />
                                        </div>
                                        <div
                                            class="card-body card_section flex-grow-1 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="mt-3 d-flex align-items-center justify-content-between">
                                                    <h5 class="card-title ps-3">{{ $product->name }}</h5>
                                                    <span class="badge mx-3 p-0 trending-bookmark-badge" onclick="event.stopPropagation();">
                                                        @if ($bookmarkedProducts->contains($product->id))
                                                        <button type="button"
                                                            class="bookmark-button remove-bookmark"
                                                            data-deal-id="{{ $product->id }}"
                                                            style="border: none; background: none;">
                                                            <p style="height:fit-content;cursor:pointer"
                                                                class="p-1 px-2">
                                                                <i class="fa-solid fa-bookmark bookmark-icon"
                                                                    style="color: #ff0060;"></i>
                                                            </p>
                                                        </button>
                                                        @else
                                                        <button type="button"
                                                            class="bookmark-button add-bookmark"
                                                            data-deal-id="{{ $product->id }}"
                                                            style="border: none; background: none;">
                                                            <p style="height:fit-content;cursor:pointer"
                                                                class="p-1 px-2">
                                                                <i class="fa-regular fa-bookmark bookmark-icon"
                                                                    style="color: #ff0060;"></i>
                                                            </p>
                                                        </button>
                                                        @endif

                                                    </span>
                                                </div>
                                                <span class="px-3">
                                                    @php
                                                    $fullStars = floor($product->shop->shop_ratings);
                                                    $hasHalfStar =
                                                    $product->shop->shop_ratings - $fullStars >= 0.5;
                                                    $remaining =
                                                    5 - ($hasHalfStar ? $fullStars + 1 : $fullStars);
                                                    @endphp
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fa-solid fa-star" style="color: #ffc200;"></i>
                                                        @endfor
                                                        @if ($hasHalfStar)
                                                        <i class="fa-solid fa-star-half-stroke"
                                                            style="color: #ffc200;"></i>
                                                        @endif
                                                        @for ($i = 0; $i < $remaining; $i++)
                                                            <i class="fa-regular fa-star" style="color: #ffc200;"></i>
                                                            @endfor
                                                </span>
                                                <p class="px-3 fw-normal truncated-description">
                                                    {{ $product->description }}
                                                </p>
                                            </div>
                                            <div>
                                                <div class="card-divider"></div>
                                                <p class="ps-3 fw-medium d-flex align-items-center justify-content-between"
                                                    style="color: #ff0060">
                                                    <span
                                                        class="discounted-price">{{ $product->discounted_price }}</span>
                                                    @if (!empty($product->coupon_code))
                                                    <span id="mySpan" class="mx-3 px-2 couponBadge"
                                                        onclick="copySpanText(this, event)"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Click to Copy" style="position:relative;">

                                                        {{ $product->coupon_code }}

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
                                                <div class="ps-3">
                                                    <p>Regular Price</p>
                                                    <p><s class="original-price">{{ $product->original_price }}</s>
                                                    </p>
                                                </div>
                                                <div class="card-divider"></div>
                                                <p class="ps-3 fw-medium"
                                                    style="color: #ff0060; font-weight: 400 !important;">
                                                    <i
                                                        class="fa-solid fa-location-dot"></i>&nbsp;{{ str_replace(',', ' ',  $product->shop->city) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-center align-items-center">
                                <style>
                                    .pagination .page-link {
                                        background-color: white;
                                        color: lightcoral;
                                        border: 1px solid #ff0060;
                                    }

                                    .pagination .page-link:hover {
                                        background-color: rgba(228, 72, 72, 0.318);
                                        color: white;
                                    }

                                    .pagination .active .page-link {
                                        background-color: #ff0060;
                                        color: white;
                                        border-color: #ff0060;
                                    }
                                </style>

                                {{ $deals->appends(request()->except('page'))->links() }}

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-12 mb-3">
                        <div class="card p-2 d-flex justify-content-center align-items-center"
                            style="border-radius: 10px;border: none">
                            <div class="row justify-content-center">
                                <div class="col-6 p-1">
                                    <div class="card h-100 prodFilterCard"
                                        style="border-color: #1878f3; border-radius: 10px;">
                                        <a href="https://www.facebook.com/profile.php?id=61566743978973" target="_blank"
                                            style="text-decoration: none;">
                                            <div class="p-2 qr-code">
                                                <img src="{{ asset('assets/images/home/facebook_qr_code.png') }}"
                                                    alt="Facebook QR" class="img-fluid">
                                            </div>
                                            <div class="icon-facebook icon-text">
                                                <i class="fa-brands fa-facebook-f"
                                                    style="color: #1878f3; padding: 3px 5px;"></i>
                                                <span style="white-space: nowrap;">Follow Us</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 p-1">
                                    <div class="card h-100 prodFilterCard"
                                        style="border-color: #cc2366; border-radius: 10px;">
                                        <a href="https://www.instagram.com/dealsmachi/" target="_blank"
                                            style="text-decoration: none;">
                                            <div class="p-2 qr-code">
                                                <img src="{{ asset('assets/images/home/instagram_qr_code.png') }}"
                                                    alt="Instagram QR" class="img-fluid">
                                            </div>
                                            <div class="icon-instagram icon-text">
                                                <i class="fa-brands fa-instagram"
                                                    style="color: #cc2366; padding: 3px 4px;"></i>
                                                <span style="white-space: nowrap;">Follow Us</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 p-1">
                                    <div class="card h-100 prodFilterCard"
                                        style="border-color: #FF0000; border-radius: 10px;">
                                        <a href="https://www.youtube.com/channel/UCAyH2wQ2srJE8WqvII8JNrQ" target="_blank"
                                            style="text-decoration: none;">
                                            <div class="p-2 qr-code">
                                                <img src="{{ asset('assets/images/home/youtube_qr_code.png') }}"
                                                    alt="YouTube QR" class="img-fluid">
                                            </div>
                                            <div class="icon-youtube icon-text">
                                                <i class="fa-brands fa-youtube" style="color: #FF0000;"></i>
                                                <span>Subscribe</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 p-1">
                                    <div class="card h-100 prodFilterCard"
                                        style="border-color: #25D366; border-radius: 10px;">
                                        <a href="https://chat.whatsapp.com/Ef23qGMU1d6EXYpRvomaLx" target="_blank"
                                            style="text-decoration: none;">
                                            <div class="p-2 qr-code">
                                                <img src="{{ asset('assets/images/home/whatsapp_qr_code.png') }}"
                                                    alt="WhatsApp QR" class="img-fluid">
                                            </div>
                                            <div class="icon-whatsapp icon-text">
                                                <i class="fa-brands fa-whatsapp"
                                                    style="color: #25D366; padding: 3px 4px;"></i>
                                                <span>Join Us</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-6 p-1">
                                    <div class="card h-100 prodFilterCard"
                                        style="border-color: #28a8e9; border-radius: 10px;">
                                        <a href="https://t.me/+UTD7rFen3K4zNDFl" target="_blank"
                                            style="text-decoration: none;">
                                            <div class="p-2 qr-code">
                                                <img src="{{ asset('assets/images/home/telegram_qr_code.png') }}"
                                                    alt="Telegram QR" class="img-fluid">
                                            </div>
                                            <div class="icon-telegram icon-text">
                                                <i class="fa-brands fa-telegram" style="color: #28a8e9;"></i>
                                                <span>Follow Us</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Filters Section for Empty Product Show -->
            @else
            @php
            $currentUrl = request()->path();
            @endphp

            @if ($currentUrl === 'hotpick/nearby')
            <div class="col-12 d-flex justify-content-center align-items-center text-center"
                style="min-height: 60vh;">
                <div class="col-12 col-md-12" style="color: rgb(128, 128, 128);">
                    <h4>Oh no! It looks like there are no nearby deals available at your location right now.
                    </h4>
                    <p style="margin-top: 10px; font-size: 14px;">Don't worry, we're always adding more
                        exciting offers just for you.<br><br> Why not explore other categories or try searching
                        in a
                        different area?</p>
                    <a href="{{ url('/') }}" style="color: #007BFF; text-decoration: underline;">Back to
                        Home</a>
                </div>
            </div>
            @else
            <div class="col-12 d-flex justify-content-center align-items-center text-center"
                style="min-height: 60vh;">
                <div class="col-12 col-md-12" style="color: rgb(128, 128, 128);">
                    <h2>Something Awesome is Coming Soon!</h2>
                </div>
            </div>
            @endif

            @endif
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script>
    const clearUrl = "{{ $isCategory ? route('deals.subcategorybased', ['slug' => $category->slug]) : ($isHotpick ? route('deals.categorybased', ['slug' => request()->segment(2)]) : ($isAll ? route('deals.subcategorybased', ['slug' => 'all']) : route('search')) ) }}";

    document.getElementById('clearButton').addEventListener('click', function() {
        preserveLatLonAndClear();
    });

    document.getElementById('clearButtonLarge').addEventListener('click', function() {
        preserveLatLonAndClear();
    });

    function preserveLatLonAndClear() {
        const categoryGroupId = "{{ request('category_group_id') }}";
        const latitude = document.getElementById('latitude').value;
        const longitude = document.getElementById('longitude').value;

        let url = new URL(clearUrl, window.location.origin);

        if (categoryGroupId) {
            url.searchParams.set('category_group_id', categoryGroupId);
        }

        if (latitude && longitude) {
            url.searchParams.set('latitude', latitude);
            url.searchParams.set('longitude', longitude);
        }

        document.getElementById('filterForm').reset();

        window.location.href = url.toString();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('applyButton').addEventListener('click', function(event) {
            event.preventDefault();
            updateFilters('mobile');
        });

        document.getElementById('applyButtonLarge').addEventListener('click', function(event) {
            event.preventDefault();
            updateFilters('desktop');
        });


        function updateFilters(screenType) {
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;

            let url = new URL(window.location.href);

            const formSelector = screenType === 'mobile' ? '#filterOffcanvas input[type="checkbox"]' : '.filterlarge input[type="checkbox"]';
            const filters = document.querySelectorAll(formSelector);

            filters.forEach(filter => {
                if (filter.checked) {
                    url.searchParams.append(filter.name, filter.value);
                } else {
                    const currentValues = url.searchParams.getAll(filter.name);
                    const updatedValues = currentValues.filter(value => value !== filter.value);

                    url.searchParams.delete(filter.name);
                    updatedValues.forEach(value => url.searchParams.append(filter.name, value));
                }
            });

            if (latitude && longitude) {
                url.searchParams.set('latitude', latitude);
                url.searchParams.set('longitude', longitude);
            }

            console.log("Updated URL:", url.toString());
            window.location.href = url.toString();
        }
    });

    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);

            console.log('Latitude:', position.coords.latitude);
            console.log('Longitude:', position.coords.longitude);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    var permissionDeniedModal = new bootstrap.Modal(document.getElementById('permissionDeniedModal'));
                    permissionDeniedModal.show();
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    });
</script>
@endsection