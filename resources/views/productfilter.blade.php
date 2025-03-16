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

{{-- social QR links  --}}
<div>
    <button type="button" class="filter_social_links">
        <i class="fixex_icons fa-brands fa-facebook-f" style="color:#fff; background: #1878f3;" aria-label="Facebook"
            onmouseover="showDropdown('social_dropdown_fb')" onmouseout="hideDropdown('social_dropdown_fb')"></i>

        <i class="fixex_icons fa-brands fa-instagram" style="color:#fff; background: #e4405f;" aria-label="Instagram"
            onmouseover="showDropdown('social_dropdown_ig')" onmouseout="hideDropdown('social_dropdown_ig')"></i>

        <i class="fixex_icons fa-brands fa-youtube" style="color:#fff; background: #FF0000;" aria-label="YouTube"
            onmouseover="showDropdown('social_dropdown_yt')" onmouseout="hideDropdown('social_dropdown_yt')"></i>

        <i class="fixex_icons fa-brands fa-whatsapp" style="color:#fff; background: #25D366;" aria-label="WhatsApp"
            onmouseover="showDropdown('social_dropdown_wa')" onmouseout="hideDropdown('social_dropdown_wa')"></i>

        <i class="fixex_icons fa-brands fa-telegram" style="color:#fff; background: #0088CC;" aria-label="Telegram"
            onmouseover="showDropdown('social_dropdown_tg')" onmouseout="hideDropdown('social_dropdown_tg')"></i>
    </button>

    <div id="social_dropdown_fb" class="filter_dropdown_items dorp_fb" style="display: none">
        <div class="card d-flex justify-content-center align-items-start" style="border-radius: 10px;border: none">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 h-100">
                        <a href="https://www.facebook.com/profile.php?id=61567112492283" target="_blank"
                            style="text-decoration: none;">
                            <div class="qr-code">
                                <img src="{{ asset('assets/images/home/facebook_qr_code.webp') }}" alt="Facebook QR"
                                    class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="social_dropdown_ig" class="filter_dropdown_items dorp_ig" style="display: none">
        <div class="card d-flex justify-content-center align-items-start" style="border-radius: 10px;border: none">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 h-100">
                        <a href="https://www.instagram.com/dealslah/" target="_blank" style="text-decoration: none;">
                            <div class="qr-code">
                                <img src="{{ asset('assets/images/home/instagram_qr_code.webp') }}" alt="Facebook QR"
                                    class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="social_dropdown_yt" class="filter_dropdown_items dorp_yt" style="display: none">
        <div class="card d-flex justify-content-center align-items-start" style="border-radius: 10px;border: none">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 h-100">
                        <a href="https://www.youtube.com/@DEALSLAH" target="_blank"
                            style="text-decoration: none;">
                            <div class="qr-code">
                                <img src="{{ asset('assets/images/home/youtube_qr_code.webp') }}" alt="Facebook QR"
                                    class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="social_dropdown_wa" class="filter_dropdown_items dorp_wa" style="display: none">
        <div class="card d-flex justify-content-center align-items-start" style="border-radius: 10px;border: none">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 h-100">
                        <a href="https://chat.whatsapp.com/KR2syYEj3Eo3JwsClx5Zws" target="_blank"
                            style="text-decoration: none;">
                            <div class="qr-code">
                                <img src="{{ asset('assets/images/home/whatsapp_qr_code.webp') }}" alt="Facebook QR"
                                    class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="social_dropdown_tg" class="filter_dropdown_items dorp_tg" style="display: none">
        <div class="card d-flex justify-content-center align-items-start" style="border-radius: 10px;border: none">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 h-100">
                        <a href="https://t.me/dealslah" target="_blank" style="text-decoration: none;">
                            <div class="qr-code">
                                <img src="{{ asset('assets/images/home/telegram_qr_code.webp') }}" alt="Facebook QR"
                                    class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="categoryIcons">
    @php
    $isCategory = !empty($category);
    $isHotpick = request()->is('hotpick/*');
    $isAll = request('slug') === 'all';
    @endphp
    <form method="GET"
        action="{{ $isAll
                ? route('deals.subcategorybased', ['slug' => 'all'])
                : ($isCategory
                    ? route('deals.subcategorybased', ['slug' => $category->slug])
                    : ($isHotpick
                        ? route('deals.categorybased', ['slug' => request()->segment(2)])
                        : route('search'))) }}"
        id="filterForm">
        @if ($isAll)
        <input type="hidden" id="category_group_id" name="category_group_id"
            value="{{ request('category_group_id') }}">
        @endif
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <input type="hidden" name="dmbk" id="dmbkInput" value="">
        <div class="p-4 topFilter">
            <div class="row d-flex align-items-center">
                <!-- Beauty Spa and Hair Section -->
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    @if (!empty($categorygroup) && !empty($category))
                    <div class="d-flex justify-content-start breadcrumb_section">
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
                                <option value="10" {{ request()->input('per_page', 10) == 10 ? 'selected' : '' }}>
                                    10
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
            @if ($deals?->isNotEmpty())
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
                            <p class="topText3 mb-1" style="border-bottom: 1px solid black; width:fit-content">
                                Brand
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
                                    <i class="fa-solid fa-star" style="color: #FFC107"></i>
                                    <!-- Full star -->
                                    @elseif ($i == floor($item->shop_ratings) + 1 && $item->shop_ratings - floor($item->shop_ratings) >= 0.5)
                                    <i class="fa-solid fa-star-half-stroke" style="color: #FFC107"></i>
                                    <!-- Half star -->
                                    @else
                                    <i class="fa-regular fa-star" style="color: #FFC107"></i>
                                    <!-- Empty star -->
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
                            <input class="form-check-input" type="checkbox" name="price_range[]" value="$0-$50"
                                id="price_0_50"
                                {{ in_array('$0-$50', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_0_50">
                                Under $50
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$50-$150" id="price_50_150"
                                {{ in_array('$50-$150', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_50_150">
                                $50 - $150
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$150-$500" id="price_150_500"
                                {{ in_array('$150-$500', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_150_500">
                                $150 - $500
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$500-$1000" id="price_500_1000"
                                {{ in_array('$500-$1000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_500_1000">
                                $500 - $1000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$1000-$10000" id="price_1000_10000"
                                {{ in_array(' $1000-$10000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_1000_10000">
                                Above $1000
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
            @if ($deals?->isNotEmpty())
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
                                id="rating_item{{ $loop->index }}"
                                {{ in_array($item->shop_ratings, request()->input('rating_item', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable"
                                for="rating_item{{ $loop->index }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <=floor($item->shop_ratings))
                                    <i class="fa-solid fa-star" style="color: #FFC107"></i>
                                    <!-- Full star -->
                                    @elseif ($i == floor($item->shop_ratings) + 1 && $item->shop_ratings - floor($item->shop_ratings) >= 0.5)
                                    <i class="fa-solid fa-star-half-stroke"
                                        style="color: #FFC107"></i> <!-- Half star -->
                                    @else
                                    <i class="fa-regular fa-star" style="color: #FFC107"></i>
                                    <!-- Empty star -->
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
                                value="$0-$50" id="price_0_to_50"
                                {{ in_array('$0-$50', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_0_to_50">
                                Under $50
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$50-$150" id="price_50_to_150"
                                {{ in_array('$50-$150', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_50_to_150">
                                $50 - $150
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$150-$500" id="price_150_to_500"
                                {{ in_array('$150-$500', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_150_to_500">
                                $150 - $500
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$500-$1000" id="price_500_to_1000"
                                {{ in_array('$500-$1000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_500_to_1000">
                                $500 - $1000
                            </label>
                        </div>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="checkbox" name="price_range[]"
                                value="$1000-$10000" id="price_1000_to_10000"
                                {{ in_array('$1000-$10000', request()->get('price_range', [])) ? 'checked' : '' }}>
                            <label class="form-check-label categoryLable" for="price_1000_to_10000">
                                Above $1000
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
                @if (request()->routeIs('deals.subcategorybased'))
                <div class="container mb-3 topbarContainer">
                    <div class="scroll-container">
                        <div class="d-flex overflow-auto topBar" style="width: 100%; white-space: nowrap;">
                            <a data-category-url="{{ url('categories/all?category_group_id=' . $categorygroup->id) }}"
                                class="btn me-2 category-link {{ request('slug') === 'all' && request('category_group_id') == $categorygroup->id ? 'active' : '' }}">
                                All
                            </a>
                            @foreach ($categorygroup->categories as $cat)
                            <a data-category-url="{{ url('categories/' . $cat->slug) }}"
                                class="btn mx-2 category-link {{ request('slug') === $cat->slug && request('slug') !== 'all' ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                            @endforeach
                        </div>
                        <div class="custom-scrollbar">
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-12">
                        <div class="row pb-4">
                            @foreach ($deals as $product)
                            <div
                                class="col-md-4 col-lg-4 col-xxl-3 col-12 mb-3 d-flex justify-content-center align-items-stretch">
                                <a data-product-id="{{ $product->id }}" class="productCard" style="text-decoration: none;"
                                    onclick="clickCount('{{ $product->id }}')">
                                    <div class="card sub_topCard h-100 d-flex flex-column">
                                        <div style="min-height: 50px">
                                            <span class="badge trending-badge">{{ $product->label }}</span>
                                            @php
                                            $image = isset($product->productMedia)
                                            ? $product->productMedia
                                            ->where('order', 1)
                                            ->where('type', 'image')
                                            ->first()
                                            : null;
                                            @endphp
                                            <img src="{{ $image ? asset($image->resize_path) : asset('assets/images/home/noImage.webp') }}"
                                                class="img-fluid card-img-top1" alt="{{ $product->name }}" />
                                        </div>
                                        <div
                                            class="card-body card_section flex-grow-1 d-flex flex-column justify-content-between">
                                            <div>
                                                <div
                                                    class="mt-3 d-flex align-items-center justify-content-between">
                                                    <h5 class="card-title ps-3">{{ $product->name }}</h5>
                                                    <span class="badge mx-3 p-0 trending-bookmark-badge"
                                                        onclick="event.stopPropagation();">
                                                        @if ($bookmarkedProducts->contains($product->id))
                                                        <button type="button"
                                                            class="bookmark-button remove-bookmark"
                                                            data-deal-id="{{ $product->id }}"
                                                            style="border: none; background: none;">
                                                            <p style="height:fit-content;cursor:pointer"
                                                                class="p-1 px-2" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Bookmark">
                                                                <i class="fa-solid fa-bookmark icon_size"
                                                                    style="color: #ef4444;"></i>
                                                            </p>
                                                        </button>
                                                        @else
                                                        <button type="button"
                                                            class="bookmark-button add-bookmark"
                                                            data-deal-id="{{ $product->id }}"
                                                            style="border: none; background: none;">
                                                            <p style="height:fit-content;cursor:pointer"
                                                                class="p-1 px-2" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Bookmark">
                                                                <i class="fa-regular fa-bookmark icon_size"
                                                                    style="color: #ef4444;"></i>
                                                            </p>
                                                        </button>
                                                        @endif

                                                    </span>
                                                </div>
                                                <span class="px-3">
                                                    @php
                                                    $fullStars = floor($product->shop->shop_ratings);
                                                    $hasHalfStar =
                                                    $product->shop->shop_ratings - $fullStars >=
                                                    0.5;
                                                    $remaining =
                                                    5 -
                                                    ($hasHalfStar ? $fullStars + 1 : $fullStars);
                                                    @endphp
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fa-solid fa-star"
                                                        style="color: #ffc200;"></i>
                                                        @endfor
                                                        @if ($hasHalfStar)
                                                        <i class="fa-solid fa-star-half-stroke"
                                                            style="color: #ffc200;"></i>
                                                        @endif
                                                        @for ($i = 0; $i < $remaining; $i++)
                                                            <i class="fa-regular fa-star"
                                                            style="color: #ffc200;"></i>
                                                            @endfor
                                                </span>
                                                <p class="px-3 fw-normal truncated-description">
                                                    {{ $product->description }}
                                                </p>
                                            </div>
                                            <div>
                                                <div class="card-divider"></div>
                                                <p class="ps-3 fw-medium d-flex align-items-center justify-content-between"
                                                    style="color: #ef4444">
                                                    <span>${{ number_format($product->discounted_price, 2) }}</span>
                                                    @if (!empty($product->coupon_code))
                                                    <span id="mySpan" class="mx-3 px-2 couponBadge"
                                                        onclick="copySpanText(this, event)"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Click to Copy"
                                                        style="position:relative;">

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
                                                <div
                                                    class="ps-3 d-flex justify-content-between align-items-center pe-2">
                                                    <div>
                                                        <p>Regular Price</p>
                                                        @if ($product->deal_type == 2)
                                                        <span style="color: #22cb00ab !important">Standard
                                                            Rates</span>
                                                        @else
                                                        <span><s>${{ number_format($product->original_price, 2) }}</s>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <button class="btn card_cart add-to-cart-btn"
                                                            data-slug="{{ $product->slug }}"
                                                            onclick="event.stopPropagation();">
                                                            Add to Cart
                                                        </button>&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="card-divider"></div>
                                                <p class="ps-3 fw-medium"
                                                    style="color: #ef4444; font-weight: 400 !important;">
                                                    <i
                                                        class="fa-solid fa-location-dot"></i>&nbsp;{{ $product->shop->country }}
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
                                        border: 1px solid #ef4444;
                                    }

                                    .pagination .page-link:hover {
                                        background-color: rgba(228, 72, 72, 0.318);
                                        color: white;
                                    }

                                    .pagination .active .page-link {
                                        background-color: #ef4444;
                                        color: white;
                                        border-color: #ef4444;
                                    }
                                </style>

                                {{ $deals->appends(request()->except('page'))->links() }}

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-3 productFilter">

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
            <div class="row">
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
                                <p class="topText3 mb-1"
                                    style="border-bottom: 1px solid black; width:fit-content">
                                    Brand
                                </p>
                            </div>
                            {{-- @if ($brands && count($brands) > 0) --}}
                            @foreach ($brands as $brand)
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="brand[]"
                                    value="{{ $brand }}" id="brand_{{ $loop->index }}"
                                    {{ in_array($brand, request()->input('brand', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable"
                                    for="brand_{{ $loop->index }}">
                                    {{ str_replace('_', ' ', $brand) }}
                                </label>
                            </div>
                            @endforeach
                            {{-- @else
                                            <p class="text-muted">No brands available.</p>
                                        @endif --}}
                        </div>

                        <!-- Discount Filter -->
                        <div class="px-5 pb-3">
                            <div class="d-flex flex-column">
                                <p class="topText3">Discount Offer</p>
                                <div class="textline2"></div>
                            </div>
                            {{-- @if ($discounts && count($discounts) > 0) --}}
                            @foreach ($discounts as $discount)
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="discount[]"
                                    value="{{ $discount }}" id="discount_{{ $loop->index }}"
                                    {{ in_array($discount, request()->input('discount', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable"
                                    for="discount_{{ $loop->index }}">
                                    {{ number_format($discount, 0) }}%
                                </label>
                            </div>
                            @endforeach
                            {{-- @else
                                            <p class="text-muted">No Discount available.</p>
                                        @endif --}}
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
                                <label class="form-check-label categoryLable"
                                    for="rating_{{ $loop->index }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <=floor($item->shop_ratings))
                                        <i class="fa-solid fa-star" style="color: #FFC107"></i>
                                        <!-- Full star -->
                                        @elseif ($i == floor($item->shop_ratings) + 1 && $item->shop_ratings - floor($item->shop_ratings) >= 0.5)
                                        <i class="fa-solid fa-star-half-stroke"
                                            style="color: #FFC107"></i>
                                        <!-- Half star -->
                                        @else
                                        <i class="fa-regular fa-star" style="color: #FFC107"></i>
                                        <!-- Empty star -->
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
                                    value="$0-$50" id="price_0_50"
                                    {{ in_array('$0-$50', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_0_50">
                                    Under $50
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$50-$150" id="price_50_150"
                                    {{ in_array('$50-$150', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_50_150">
                                    $50 - $150
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$150-$500" id="price_150_500"
                                    {{ in_array('$150-$500', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_150_500">
                                    $150 - $500
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$500-$1000" id="price_500_1000"
                                    {{ in_array('$500-$1000', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_500_1000">
                                    $500 - $1000
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$1000-$10000" id="price_1000_10000"
                                    {{ in_array(' $1000-$10000', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_1000_10000">
                                    Above $1000
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 sticky-bottom d-flex justify-content-center align-items-center mb-3">
                        <!-- Buttons inside your offcanvas -->
                        <button type="button" class="btn btn-button clear-button" id="clearButton">Clear
                            All</button>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-button apply-button"
                            id="applyButton">Apply</button>
                    </div>
                </div>
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
                            {{-- @if ($brands && count($brands) > 0) --}}
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
                            {{-- @else
                                            <p class="text-muted">No brands available.</p>
                                        @endif --}}
                        </div>

                        <!-- Discount Filter -->
                        <div class="px-5 pb-3">
                            <div class="d-flex flex-column">
                                <p class="topText3">Discount Offer</p>
                                <div class="textline2"></div>
                            </div>
                            {{-- @if ($discounts && count($discounts) > 0) --}}
                            @foreach ($discounts as $discount)
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="discount[]"
                                    value="{{ $discount }}"
                                    id="discount_large_{{ $loop->index }}"
                                    {{ in_array($discount, request()->input('discount', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable"
                                    for="discount_large_{{ $loop->index }}">
                                    {{ number_format($discount, 0) }}%
                                </label>
                            </div>
                            @endforeach
                            {{-- @else
                                            <p class="text-muted">No Discount available.</p>
                                        @endif --}}

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
                                    id="rating_item{{ $loop->index }}"
                                    {{ in_array($item->shop_ratings, request()->input('rating_item', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable"
                                    for="rating_item{{ $loop->index }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <=floor($item->shop_ratings))
                                        <i class="fa-solid fa-star" style="color: #FFC107"></i>
                                        <!-- Full star -->
                                        @elseif ($i == floor($item->shop_ratings) + 1 && $item->shop_ratings - floor($item->shop_ratings) >= 0.5)
                                        <i class="fa-solid fa-star-half-stroke"
                                            style="color: #FFC107"></i> <!-- Half star -->
                                        @else
                                        <i class="fa-regular fa-star" style="color: #FFC107"></i>
                                        <!-- Empty star -->
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
                                    value="$0-$50" id="price_0_to_50"
                                    {{ in_array('$0-$50', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_0_to_50">
                                    Under $50
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$50-$150" id="price_50_to_150"
                                    {{ in_array('$50-$150', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_50_to_150">
                                    $50 - $150
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$150-$500" id="price_150_to_500"
                                    {{ in_array('$150-$500', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_150_to_500">
                                    $150 - $500
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$500-$1000" id="price_500_to_1000"
                                    {{ in_array('$500-$1000', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_500_to_1000">
                                    $500 - $1000
                                </label>
                            </div>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="checkbox" name="price_range[]"
                                    value="$1000-$10000" id="price_1000_to_10000"
                                    {{ in_array('$1000-$10000', request()->get('price_range', [])) ? 'checked' : '' }}>
                                <label class="form-check-label categoryLable" for="price_1000_to_10000">
                                    Above $1000
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

                <div class="col-12 col-lg-9 d-flex flex-column text-center">
                    @if (request()->routeIs('deals.subcategorybased'))
                    <div class="container mb-3 topbarContainer">
                        <div class="scroll-container">
                            <div class="d-flex overflow-auto topBar"
                                style="width: 100%; white-space: nowrap;">
                                <a data-category-url="{{ url('categories/all?category_group_id=' . $categorygroup->id) }}"
                                    class="btn me-2 category-link {{ request('slug') === 'all' && request('category_group_id') == $categorygroup->id ? 'active' : '' }}">
                                    All
                                </a>
                                @foreach ($categorygroup->categories as $cat)
                                <a data-category-url="{{ url('categories/' . $cat->slug) }}"
                                    class="btn mx-2 category-link {{ request('slug') === $cat->slug && request('slug') !== 'all' ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                                @endforeach
                            </div>
                            <div class="custom-scrollbar">
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-12">
                            <div class="row pb-4">
                                @foreach ($deals as $product)
                                <div
                                    class="col-md-4 col-lg-4 col-xxl-3 col-12 mb-3 d-flex justify-content-center align-items-stretch">
                                    <a href="{{ url('/deal/' . $product->id) }}"
                                        style="text-decoration: none;"
                                        onclick="clickCount('{{ $product->id }}')">
                                        <div class="card sub_topCard h-100 d-flex flex-column">
                                            <div style="min-height: 50px">
                                                <span
                                                    class="badge trending-badge">{{ $product->label }}</span>
                                                @php
                                                $image = isset($product->productMedia)
                                                ? $product->productMedia
                                                ->where('order', 1)
                                                ->where('type', 'image')
                                                ->first()
                                                : null;
                                                @endphp
                                                <img src="{{ $image ? asset($image->resize_path) : asset('assets/images/home/noImage.webp') }}"
                                                    class="img-fluid card-img-top1"
                                                    alt="{{ $product->name }}" />
                                            </div>
                                            <div
                                                class="card-body card_section flex-grow-1 d-flex flex-column justify-content-between">
                                                <div>
                                                    <div
                                                        class="mt-3 d-flex align-items-center justify-content-between">
                                                        <h5 class="card-title ps-3">{{ $product->name }}
                                                        </h5>
                                                        <span
                                                            class="badge mx-3 p-0 trending-bookmark-badge"
                                                            onclick="event.stopPropagation();">
                                                            @if ($bookmarkedProducts->contains($product->id))
                                                            <button type="button"
                                                                class="bookmark-button remove-bookmark"
                                                                data-deal-id="{{ $product->id }}"
                                                                style="border: none; background: none;">
                                                                <p style="height:fit-content;cursor:pointer"
                                                                    class="p-1 px-2"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Bookmark">
                                                                    <i class="fa-regular fa-bookmark icon_size"
                                                                        style="color: #ef4444;"></i>
                                                                </p>
                                                            </button>
                                                            @else
                                                            <button type="button"
                                                                class="bookmark-button add-bookmark"
                                                                data-deal-id="{{ $product->id }}"
                                                                style="border: none; background: none;">
                                                                <p style="height:fit-content;cursor:pointer"
                                                                    class="p-1 px-2"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Bookmark">
                                                                    <i class="fa-regular fa-bookmark icon_size"
                                                                        style="color: #ef4444;"></i>
                                                                </p>
                                                            </button>
                                                            @endif

                                                        </span>
                                                    </div>
                                                    <span class="px-3">
                                                        @php
                                                        $fullStars = floor(
                                                        $product->shop->shop_ratings,
                                                        );
                                                        $hasHalfStar =
                                                        $product->shop->shop_ratings -
                                                        $fullStars >=
                                                        0.5;
                                                        $remaining =
                                                        5 -
                                                        ($hasHalfStar
                                                        ? $fullStars + 1
                                                        : $fullStars);
                                                        @endphp
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="fa-solid fa-star"
                                                            style="color: #ffc200;"></i>
                                                            @endfor
                                                            @if ($hasHalfStar)
                                                            <i class="fa-solid fa-star-half-stroke"
                                                                style="color: #ffc200;"></i>
                                                            @endif
                                                            @for ($i = 0; $i < $remaining; $i++)
                                                                <i class="fa-regular fa-star"
                                                                style="color: #ffc200;"></i>
                                                                @endfor
                                                    </span>
                                                    <p class="px-3 fw-normal truncated-description">
                                                        {{ $product->description }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="card-divider"></div>
                                                    <p class="ps-3 fw-medium d-flex align-items-center justify-content-between"
                                                        style="color: #ef4444">
                                                        <span>${{ number_format($product->discounted_price, 2) }}</span>
                                                        @if (!empty($product->coupon_code))
                                                        <span id="mySpan"
                                                            class="mx-3 px-2 couponBadge"
                                                            onclick="copySpanText(this, event)"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom"
                                                            title="Click to Copy"
                                                            style="position:relative;">

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
                                                    <div
                                                        class="ps-3 d-flex justify-content-between align-items-center pe-2">
                                                        <div>
                                                            <p>Regular Price</p>
                                                            @if ($product->deal_type == 2)
                                                            <span
                                                                style="color: #22cb00ab !important">Standard
                                                                Rates</span>
                                                            @else
                                                            <span><s>${{ number_format($product->original_price, 2) }}</s>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <button class="btn card_cart add-to-cart-btn"
                                                                data-slug="{{ $product->slug }}">
                                                                Add to Cart
                                                            </button>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="card-divider"></div>
                                                    <p class="ps-3 fw-medium"
                                                        style="color: #ef4444; font-weight: 400 !important;">
                                                        <i
                                                            class="fa-solid fa-location-dot"></i>&nbsp;{{ $product->shop->country }}
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
                                            border: 1px solid #ef4444;
                                        }

                                        .pagination .page-link:hover {
                                            background-color: rgba(228, 72, 72, 0.318);
                                            color: white;
                                        }

                                        .pagination .active .page-link {
                                            background-color: #ef4444;
                                            color: white;
                                            border-color: #ef4444;
                                        }
                                    </style>

                                    {{ $deals->appends(request()->except('page'))->links() }}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-12">

                        </div>
                    </div>
                    <div class="col-12 col-md-12 mb-5" style="color: rgb(128, 128, 128);margin-top:15%">
                        <h2>Something Awesome is Coming Soon!</h2>
                    </div>
                </div>
            </div>
            @endif

            @endif
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script>
    let hideTimeout;
    let currentlyOpenDropdown = null;

    function showDropdown(socialId) {
        const socialDropdown = document.getElementById(socialId);

        if (currentlyOpenDropdown && currentlyOpenDropdown !== socialDropdown) {
            currentlyOpenDropdown.style.display = "none";
        }

        clearTimeout(hideTimeout);

        socialDropdown.style.display = "block";

        currentlyOpenDropdown = socialDropdown;
    }

    function hideDropdown(socialId) {
        const socialDropdown = document.getElementById(socialId);

        hideTimeout = setTimeout(() => {
            socialDropdown.style.display = "none";
            if (currentlyOpenDropdown === socialDropdown) {
                currentlyOpenDropdown = null;
            }
        }, 1000);
    }



    const clearUrl =
        "{{ $isCategory ? route('deals.subcategorybased', ['slug' => $category->slug]) : ($isHotpick ? route('deals.categorybased', ['slug' => request()->segment(2)]) : ($isAll ? route('deals.subcategorybased', ['slug' => 'all']) : route('search'))) }}";

    document.getElementById('clearButton').addEventListener('click', clearAllFilters);
    document.getElementById('clearButtonLarge').addEventListener('click', clearAllFilters);

    function clearAllFilters() {
        const categoryGroupId = "{{ request('category_group_id') }}";
        const latitude = document.getElementById('latitude').value;
        const longitude = document.getElementById('longitude').value;
        const bookmarknumber = localStorage.getItem('bookmarknumber') || 'null';

        let url = new URL(clearUrl, window.location.origin);

        if (categoryGroupId) {
            url.searchParams.set('category_group_id', categoryGroupId);
        }

        if (latitude && longitude) {
            url.searchParams.set('latitude', latitude);
            url.searchParams.set('longitude', longitude);
        }

        if (bookmarknumber) {
            url.searchParams.set('dmbk', bookmarknumber);
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

            const formSelector = screenType === 'mobile' ? '#filterOffcanvas input[type="checkbox"]' :
                '.filterlarge input[type="checkbox"]';
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

    // $(document).ready(function() {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(showPosition, showError);
    //     } else {
    //         alert("Geolocation is not supported by this browser.");
    //     }

    //     function showPosition(position) {
    //         $('#latitude').val(position.coords.latitude);
    //         $('#longitude').val(position.coords.longitude);

    //         console.log('Latitude:', position.coords.latitude);
    //         console.log('Longitude:', position.coords.longitude);
    //     }

    //     function showError(error) {
    //         switch (error.code) {
    //             case error.PERMISSION_DENIED:
    //                 var permissionDeniedModal = new bootstrap.Modal(document.getElementById(
    //                     'permissionDeniedModal'));
    //                 permissionDeniedModal.show();
    //                 break;
    //             case error.POSITION_UNAVAILABLE:
    //                 alert("Location information is unavailable.");
    //                 break;
    //             case error.TIMEOUT:
    //                 alert("The request to get user location timed out.");
    //                 break;
    //             case error.UNKNOWN_ERROR:
    //                 alert("An unknown error occurred.");
    //                 break;
    //         }
    //     }
    // });

    const topBar = document.querySelector('.topBar');
    const scrollbar = document.querySelector('.custom-scrollbar');
    const scrollThumb = document.querySelector('.scroll-thumb');

    // Update thumb width and position
    function updateThumb() {
        const scrollbarWidth = scrollbar.offsetWidth;
        const contentWidth = topBar.scrollWidth;
        const visibleWidth = topBar.offsetWidth;

        // Set thumb width proportional to the visible area
        const thumbWidth = Math.max((visibleWidth / contentWidth) * scrollbarWidth, 30); // Minimum width: 30px
        scrollThumb.style.width = `${thumbWidth}px`;

        // Set thumb position proportional to the scroll position
        const scrollRatio = topBar.scrollLeft / (contentWidth - visibleWidth);
        scrollThumb.style.left = `${scrollRatio * (scrollbarWidth - thumbWidth)}px`;
    }

    // Handle thumb dragging
    let isDragging = false;
    let startX, startLeft;

    scrollThumb.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.clientX;
        startLeft = parseInt(scrollThumb.style.left, 10) || 0;
        document.body.style.userSelect = 'none'; // Prevent text selection
    });

    document.addEventListener('mousemove', (e) => {
        if (!isDragging) return;

        const deltaX = e.clientX - startX;
        const scrollbarWidth = scrollbar.offsetWidth;
        const thumbWidth = scrollThumb.offsetWidth;
        const maxScrollLeft = scrollbarWidth - thumbWidth;

        let newLeft = Math.min(Math.max(startLeft + deltaX, 0), maxScrollLeft);
        scrollThumb.style.left = `${newLeft}px`;

        // Sync topBar scroll position
        const contentWidth = topBar.scrollWidth;
        const visibleWidth = topBar.offsetWidth;
        const scrollRatio = newLeft / maxScrollLeft;
        topBar.scrollLeft = scrollRatio * (contentWidth - visibleWidth);
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
        document.body.style.userSelect = '';
    });

    // Sync thumb position on topBar scroll
    topBar.addEventListener('scroll', updateThumb);

    // Initial setup
    updateThumb();
    window.addEventListener('resize', updateThumb); // Recalculate on resize
</script>
@endsection