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
                    <i class="fa-solid fa-xmark" style="color: #ef4444"></i>
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
                    <i class="fa-solid fa-xmark" style="color: #ef4444"></i>
                </button>
            </div>
        </div>
    @endif

    <section class="categoryIcons container-fluid p-0">

        <div class="productContainer">

            {{-- social QR links  --}}
            <div>
                <button type="button" class="social_links">
                    <i class="fixex_icons fa-brands fa-facebook-f" style="color:#fff; background: #1878f3;"
                        aria-label="Facebook" onmouseover="showDropdown('social_dropdown_fb')"
                        onmouseout="hideDropdown('social_dropdown_fb')"></i>

                    <i class="fixex_icons fa-brands fa-instagram" style="color:#fff; background: #e4405f;"
                        aria-label="Instagram" onmouseover="showDropdown('social_dropdown_ig')"
                        onmouseout="hideDropdown('social_dropdown_ig')"></i>

                    <i class="fixex_icons fa-brands fa-youtube" style="color:#fff; background: #FF0000;"
                        aria-label="YouTube" onmouseover="showDropdown('social_dropdown_yt')"
                        onmouseout="hideDropdown('social_dropdown_yt')"></i>

                    <i class="fixex_icons fa-brands fa-whatsapp" style="color:#fff; background: #25D366;"
                        aria-label="WhatsApp" onmouseover="showDropdown('social_dropdown_wa')"
                        onmouseout="hideDropdown('social_dropdown_wa')"></i>

                    <i class="fixex_icons fa-brands fa-telegram" style="color:#fff; background: #0088CC;"
                        aria-label="Telegram" onmouseover="showDropdown('social_dropdown_tg')"
                        onmouseout="hideDropdown('social_dropdown_tg')"></i>
                </button>

                <div id="social_dropdown_fb" class="dropdown_items dorp_fb" style="display: none">
                    <div class="card d-flex justify-content-center align-items-start"
                        style="border-radius: 10px;border: none">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card border-0 h-100">
                                    <a href="https://www.facebook.com/profile.php?id=61567112492283" target="_blank"
                                        style="text-decoration: none;">
                                        <div class="qr-code">
                                            <img src="{{ asset('assets/images/home/facebook_qr_code.webp') }}"
                                                alt="Facebook QR" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="social_dropdown_ig" class="dropdown_items dorp_ig" style="display: none">
                    <div class="card d-flex justify-content-center align-items-start"
                        style="border-radius: 10px;border: none">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card border-0 h-100">
                                    <a href="https://www.instagram.com/dealslah/" target="_blank"
                                        style="text-decoration: none;">
                                        <div class="qr-code">
                                            <img src="{{ asset('assets/images/home/instagram_qr_code.webp') }}"
                                                alt="Facebook QR" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="social_dropdown_yt" class="dropdown_items dorp_yt" style="display: none">
                    <div class="card d-flex justify-content-center align-items-start"
                        style="border-radius: 10px;border: none">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card border-0 h-100">
                                    <a href="https://www.youtube.com/@DEALSLAH" target="_blank"
                                        style="text-decoration: none;">
                                        <div class="qr-code">
                                            <img src="{{ asset('assets/images/home/youtube_qr_code.webp') }}"
                                                alt="Facebook QR" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="social_dropdown_wa" class="dropdown_items dorp_wa" style="display: none">
                    <div class="card d-flex justify-content-center align-items-start"
                        style="border-radius: 10px;border: none">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card border-0 h-100">
                                    <a href="https://chat.whatsapp.com/KR2syYEj3Eo3JwsClx5Zw" target="_blank"
                                        style="text-decoration: none;">
                                        <div class="qr-code">
                                            <img src="{{ asset('assets/images/home/whatsapp_qr_code.webp') }}"
                                                alt="Facebook QR" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="social_dropdown_tg" class="dropdown_items dorp_tg" style="display: none">
                    <div class="card d-flex justify-content-center align-items-start"
                        style="border-radius: 10px;border: none">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card border-0 h-100">
                                    <a href="https://t.me/dealslah" target="_blank" style="text-decoration: none;">
                                        <div class="qr-code">
                                            <img src="{{ asset('assets/images/home/telegram_qr_code.webp') }}"
                                                alt="Facebook QR" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            {{-- Breadcrumb navigate  --}}
            <div class="breadcrumb-nav container mt-3 ps-3">
                <ol class="breadcrumb" style="list-style:none; padding: 0; margin:0;">
                    <li class="breadcrumb-item"><a class="breadcrumb_link" href="/"
                            style="list-style:none; text-decoration:none">Home</a></li>
                    &nbsp;
                    <span className="breadcrumb-separator" style="color: #A19F9F"> &gt; </span>&nbsp;&nbsp;
                    <li class="breadcrumb-item"><a class="breadcrumb_link" href="#"
                            style="list-style:none; text-decoration:none">Deal</a>
                    </li>&nbsp;
                    <span className="breadcrumb-separator" style="color: #A19F9F"> &gt; </span>&nbsp;&nbsp;
                    <li class="breadcrumb-item active"><span class="breadcrumb_link"> {{ $product->name }}</span></li>
                </ol>
            </div>

            {{-- main content  --}}
            <div class="container p-0 mt-4">

                <div class="row m-0 p-2">
                    <div class="col-md-6 column">
                        <div class="row m-0" style="position:sticky; top:100px">
                            @php
                                $hasMedia = $product->productMedia->whereIn('type', ['image', 'video'])->isNotEmpty();
                            @endphp
                            <div class="col-md-2 col-2 pe-md-0 image_slider_vw">
                                <div class="text-center arrow-button mb-2">
                                    <button type="button" style="border:none; background-color: #eaeaea; font-size:10px"
                                        id="scrollUpBtn" title="Scroll up" aria-label="Scroll up" onclick="scrollUp()">
                                        <i class="fa fa-angle-up" style="line-height:2;"></i>
                                    </button>
                                </div>

                                <div class="thumbnail" id="thumbnailContainer">
                                    @foreach ($product->productMedia->sortBy('order') as $media)
                                        @if ($media->type == 'image')
                                            <div>
                                                <img class="thumb-img" data-zoom="{{ asset($media->path) }}"
                                                    src="{{ asset($media->resize_path) }}" alt="Image" />
                                            </div>
                                        @elseif ($media->type == 'video')
                                            @php
                                                $videoId = preg_match(
                                                    '/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]+)/',
                                                    $media->resize_path,
                                                    $matches,
                                                )
                                                    ? $matches[1]
                                                    : $media->resize_path;
                                            @endphp
                                            <div>
                                                <img src="https://img.youtube.com/vi/{{ $videoId }}/0.jpg"
                                                    class="thumbnail img-fluid"
                                                    style="height: 60px; cursor: pointer; object-fit: cover;"
                                                    data-bs-toggle="modal" data-bs-target="#videoModal"
                                                    onclick="updateVideoModal('{{ $videoId }}')">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="text-center arrow-button mt-2">
                                    <button type="button" style="border:none; background-color: #eaeaea; font-size:10px"
                                        id="scrollDownBtn" title="Scroll down" aria-label="Scroll down"
                                        onclick="scrollDown()">
                                        <i class="fa fa-angle-down" style="line-height:2;"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-10 col-10 p-lg-0">
                                <div class="thumbnail-container">
                                    @php
                                        $firstImage = $product->productMedia
                                            ->sortBy('order')
                                            ->firstWhere('type', 'image');
                                    @endphp
                                    <img id="main-image" alt="Product Image" class="drift-demo-trigger image-fluid"
                                        data-zoom="{{ $firstImage ? asset($firstImage->path) : asset('assets/images/home/noImage.webp') }}"
                                        src="{{ $firstImage ? asset($firstImage->resize_path) : asset('assets/images/home/noImage.webp') }}" />
                                </div>
                            </div>
                            <div class="col-md-2 col-3  d-none d-md-block"></div>
                            <div class="col-md-10 col-9 mt-3">
                                <div class="add_cart_btns">
                                    <button class="btn cart_btn media_fonts_conent text-nowrap add-to-cart-btn"
                                        data-slug="{{ $product->slug }}">
                                        <i class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp;Add to Cart
                                    </button>

                                    <form action="{{ route('cart.add', ['slug' => $product->slug]) }}" method="POST">
                                        @csrf
                                        @if ($product->deal_type == 1)
                                            <input type="hidden" name="saveoption" id="saveoption" value="buy now">

                                            <button type="submit"
                                                class="Buy_btn media_fonts_conent text-nowrap buy-now-direct-btn"
                                                data-slug="{{ $product->slug }}">
                                                <i class="fa-thin fa-bag-shopping"></i>&nbsp;&nbsp;Buy Now
                                            </button>
                                        @elseif ($product->deal_type == 2)
                                            <input type="hidden" name="saveoption" id="saveoption" value="buy now">

                                            <button type="submit"
                                                class="Buy_btn media_fonts_conent text-nowrap buy-now-direct-btn"
                                                data-slug="{{ $product->slug }}">
                                                <i class="fa-thin fa-bag-shopping"></i>&nbsp;&nbsp;Book Now
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ps-4 mt-3 space_ctrl column">
                        <span class="details" style="position:fixed; top:100px"></span>
                        <div>
                            <div class="fst_rw d-flex align-items-center">
                                <h2 class="d-flex text-start mb-0">
                                    {{ $product->name }}
                                </h2>
                                <p style="color: #000000" class="media_fonts_headings text-nowrap mb-0">
                                    <span>
                                        @if ($bookmarkedProducts->contains($product->id))
                                            <button type="button" class="bookmark-button remove-bookmark"
                                                data-deal-id="{{ $product->id }}"
                                                style="border: none; background: none; font-size: medium !important; padding: 20px 0 0 30px">
                                                <p style="height: fit-content; cursor: pointer;" class="p-1 px-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="bookmark">
                                                    <i class="fa-regular fa-bookmark fa-xl icon_size"
                                                        style="color: #ef4444;"></i>
                                                </p>
                                            </button>
                                        @else
                                            <button type="button" class="bookmark-button add-bookmark"
                                                data-deal-id="{{ $product->id }}"
                                                style="border: none; background: none; font-size:14px; padding: 20px 0 0 20px">
                                                <p style="height: fit-content; cursor: pointer;" class="p-1 px-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="bookmark">
                                                    <i class="fa-regular fa-bookmark fa-xl icon_size"
                                                        style="color: #ef4444;"></i>
                                                </p>
                                            </button>
                                        @endif
                                    </span>
                                </p>
                                <div class="share px-2">
                                    <button type="button" id="share_btn" style="height: fit-content; cursor: pointer;"
                                        class="p-1  text-nowrap media_fonts_conent"
                                        onclick="copyLinkToClipboard(this, event, '{{ $product->id }}')"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Share">
                                        <span>&nbsp; &nbsp;Share &nbsp; &nbsp;<i class="fa-regular fa-share"></i></span>

                                        <span class="tooltip-text">
                                            Link Copied!
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="rating mt-2">
                                <span>Rating :</span><span class="stars">
                                    @php
                                        $fullStars = floor($product->shop->shop_ratings);
                                        $hasHalfStar = $product->shop->shop_ratings - $fullStars >= 0.5;
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
                            </div>

                            @if ($product->deal_type == 2)
                                <div class="price-section mt-4 d-flex align-items-center">
                                    <h3>
                                        <span
                                            class="current-price mt-2">${{ number_format($product->discounted_price, 2) }}</span>
                                    </h3>
                                    <span class="original-price"></span>
                                    <span class="discount-price"></span>
                                    @if (!empty($product->coupon_code))
                                        <div>
                                            <p>
                                                <span id="mySpan" class="deal-badge"
                                                    style="cursor: pointer; position:relative;"
                                                    onclick="copySpan(this, event)" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Click to Copy">

                                                    {{ $product->coupon_code }}

                                                    <!-- Tooltip container -->
                                                    <span class="tooltip-text tooltip_dec">
                                                        Copied!
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                    @endif

                                </div>
                                <div class="rating mt-3 mb-3">
                                    <span style="color: #22cb00">Currently Services are free through Dealslah</span>
                                </div>
                            @else
                                <div class="price-section d-flex align-items-center mt-4">
                                    <div>
                                        <span
                                            class="current-price mt-4">${{ number_format($product->discounted_price, 2) }}</span>
                                        &nbsp;&nbsp;
                                        <span
                                            class="original-price coupon-align">${{ number_format($product->original_price, 2) }}</span>
                                        <span
                                            class="discount-price coupon-align1 text-nowrap">{{ round($product->discount_percentage) }}%
                                            off</span>
                                    </div>
                                    @if (!empty($product->coupon_code))
                                        <div>
                                            <p class="d-flex justify-content-start">
                                                <span id="mySpan" class="deal-badge mt-3"
                                                    style="cursor: pointer; position:relative;"
                                                    onclick="copySpan(this, event)" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Click to Copy">

                                                    {{ $product->coupon_code }}

                                                    <!-- Tooltip container -->
                                                    <span class="tooltip-text tooltip_dec">
                                                        Copied!
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div>
                                @php
                                    use Carbon\Carbon;

                                    $currentDate = Carbon::now();

                                    $deliveryDays = is_numeric($product->delivery_days)
                                        ? (int) $product->delivery_days
                                        : 0;

                                    $deliveryDate =
                                        $deliveryDays > 0
                                            ? $currentDate->addDays($deliveryDays)->format('d-m-Y')
                                            : null;
                                @endphp
                                @if ($product->deal_type == 1)
                                    <div class="rating mt-3 mb-4">
                                        <span>Delivery Date :</span>
                                        <span class="stars">
                                            <span>
                                                {{ $deliveryDays > 0 ? $deliveryDate : 'No delivery date available' }}
                                            </span>
                                        </span>
                                    </div>
                                    @php
                                        $varients = $product->varient ?? '';

                                        $varientArray = array_filter(explode(',', $varients));
                                    @endphp
                                    @if (!empty($varientArray))
                                        <div class="delivery-badges mt-3">
                                            @foreach ($varientArray as $varient)
                                                <span class="badge-item">{{ trim($varient) }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>

                            @if ($product->shop->show_name_on_website)
                                <div class="">
                                    <span> Seller Company Name: {{ $product->shop->legal_name }}</span>
                                </div>
                            @endif

                            {{-- description  --}}
                            <div class="description-section mt-4">
                                @if ($product->deal_type == 1)
                                    <h5>Product Description : </h5>
                                @elseif ($product->deal_type == 2)
                                    <h5 class="media_fonts_headings">Service Description : </h5>
                                @endif
                                <p><span class="text-muted media_fonts_conent">{{ $product->description }}</span></p>
                                <div class="mt-2"
                                    style="border: 1px solid #c1bcbc40;border-radius:5px; width: fit-content">
                                    <div class="row m-0">
                                        <p class="text-center p-1"
                                            style="border-bottom: 1px solid #76737340; font-size:12px;">
                                            Share on Social Media</p>

                                        <div class="d-flex  justify-content-center mt-2 social-link-container"
                                            style="z-index:0" data-product-id="{{ $product->id }}">
                                            {!! $shareButtons !!}

                                            <a href="#" onclick="shareOnInstagram()" id="" title=""
                                                rel="">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- seller Info  --}}
                            {{-- <div class="seller-information mt-4">
    <h5 class="media_fonts_headings">Seller Information :</h5>
    <div class="card_offers p-3">
        <div class="d-flex justify-content-between align-items-center my-2 mb-3">
            <a href="#" class="modal_links" data-bs-toggle="modal"
                data-bs-target="#aboutModal">
                <span>About</span>
            </a>&nbsp;&nbsp;
            <h5 class="modal-title">{{ $product->shop->name }}</h5>
            <a href="#" class="modal_links" data-bs-toggle="modal"
                data-bs-target="#workingHoursModal">
                <span>Working Hours</span>
            </a>
        </div>
        <p class="quickInfo">{{ $product->shop->description }}</p>
        <div class="row m-0 py-3 space_ctrl">
            <h5 class="modal-title">{{ $product->shop->name }}</h5>
            <p class="quickInfo">{{ $product->shop->description }}</p>
            <div class="col-12 space_ctrl">
                <div class="row m-0 pb-3">
                    <div class="col-md-12 col-lg-6 col-12 space_ctrl">
                        <div class="row m-0">
                            <div class="col-2 pe-0">
                                <i class="fa-solid fa-location-dot fa-lg"
                                    style="color: #ef4444;"></i>
                            </div>
                            @if ($product->shop->address)
                                <div class="col-10 ps-2"
                                    style="font-size: 12px; color: #5C5C5C;">
                                    <a href="{{ $product->shop->map_url }}"
                                        class="text-muted" target="_blank"
                                        style="text-decoration: none;">
                                        <p>{{ $product->shop->address }}<p>
                                    </a>
                                </div>
                            @else
                                No Address Found
                            @endif
                        </div>
                    </div>
                    <div class="md-6 col-lg-6 col-12 space_ctrl">
                        @if ($product->shop->mobile)
                            <div class="row m-0">
                                <div class="col-2 pe-0">
                                    <i class="fa-solid fa-phone fa-lg"
                                        style="color: #ef4444;"></i>
                                </div>
                                <div class="col-10 ps-2"
                                    style="font-size: 18px; color: #5C5C5C;">
                                    <a href="{{ $product->shop->mobile }}"
                                        class="text-decoration-none text-black"
                                        data-full-number="{{ $product->shop->mobile }}"
                                        data-masked-number="{{ substr($product->shop->mobile, 0, 4) . str_repeat('x', strlen($product->shop->mobile) - 4) }}"
                                        onclick="toggleNumber(event)">
                                        {{ substr($product->shop->mobile, 0, 4) . str_repeat('x', strlen($product->shop->mobile) - 4) }}
                                    </a>
                                </div>
                            </div>
                        @else
                        @endif
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12 gap-3 sendEnquiry-des-btn">
                        <button type="button" class="btn mb-2 sendEnqBtn text-nowrap"
                            onclick="window.location.href='tel:{{ $product->shop->mobile }}'">
                            <i class="fa-solid fa-phone fa-xs"></i>&nbsp;&nbsp;Call
                        </button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn mb-2 sendEnqBtn text-nowrap"
                            data-bs-toggle="modal" data-bs-target="#enquiryModal">
                            Send Enquiry
                        </button>&nbsp;&nbsp;&nbsp;

                        @if ($product->shop->mobile)
                            <button type="button" class="btn mb-2 sendEnqBtn text-nowrap"
                                onclick="sendEnquiry('{{ $product->id }}', '{{ $product->shop->mobile }}', '{{ $product->name }}', '{{ $product->description }}')">
                                <i class="fa-brands fa-whatsapp"></i>&nbsp;&nbsp;Whatsapp
                                Enquiry
                            </button>
                        @else
                            <button type="button" class="btn mb-2 sendEnqBtn" disabled
                                onclick="window.open('https://wa.me/65{{ $product->shop->mobile }}?text=Hello! I visited your website.', '_blank')">
                                <i class="fa-brands fa-whatsapp"></i>&nbsp;&nbsp;Enquiry
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

                            {{-- specification  --}}
                            @if (!empty($product->specifications))
                                <div class="specification-section mt-4">
                                    <h5>Specifications :</h5>
                                    <div class="">
                                        <p class="media_fonts_conent">
                                            {{ $product->specifications ?? 'No Specifications Found' }}
                                        </p>
                                    </div>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row m-0 mt-3 px-3">
                    <div class="col-12 px-2">

                    </div>
                </div>

                {{-- owl carousel  --}}
                <div class="row m-0 mt-3">
                    <div class="col-12 ">
                        @php
                            // Filter and sort product media for videos only
                            $videos = $product->productMedia->where('type', 'video')->sortBy('order');
                        @endphp

                        @if ($videos->count() > 0)
                            <div class="p-3 position-relative card py-5">
                                <div class="owl-carousel carousel_content owl-theme image-slider1 d-flex gap-3 overflow-hidden carousel-container"
                                    id="carousel_slider"
                                    style="scroll-snap-type: x mandatory; overflow-x: auto; white-space: nowrap;">

                                    @foreach ($videos as $video)
                                        @php
                                            $videoId = preg_match(
                                                '/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]+)/',
                                                $video->resize_path,
                                                $matches,
                                            )
                                                ? $matches[1]
                                                : $video->resize_path;
                                        @endphp

                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/0.jpg"
                                            alt="Video Thumbnail {{ $video->order }}" class="img-fluid item"
                                            data-bs-toggle="modal" data-bs-target="#videoModal"
                                            onclick="updateVideoModal('{{ $videoId }}')">
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="p-3 position-relative card py-3">
                                <div class="d-flex justify-content-center align-item-center p-5">
                                    <p class="text-muted mb-0">No videos available for this product.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- review section   --}}
                <div class="review-section mt-4 px-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="media_fonts_headings">Reviews</h5>
                    </div>
                    <div class="card_offers review_section p-3">
                        @php
                            $hasReviews = false;
                            $totalRating = 0;
                            $totalReviews = 0;
                        @endphp

                        @foreach ($reviewData as $reviewSet)
                            @php
                                $hasReviews = true;
                                $totalRating += $reviewSet->rating;
                                $totalReviews++;
                            @endphp
                        @endforeach

                        @if ($hasReviews)
                            @php
                                $averageRating = $totalReviews ? round($totalRating / $totalReviews, 1) : 0;
                            @endphp

                            <!-- Rating Summary -->
                            <div class="rating-summary mb-4">
                                <div class="d-flex align-items-center">
                                    <h5>Total score :</h5>
                                    &nbsp;&nbsp;
                                    <h2 class="average-rating me-2 d-flex align-items-center" style="color:#40d128;">
                                        {{ $averageRating }}
                                        @php
                                            $fullStars = floor($averageRating);
                                            $hasHalfStar = $averageRating - $fullStars >= 0.5;
                                        @endphp
                                        @for ($i = 1; $i <= $fullStars; $i++)
                                            <i class="fa-solid fa-star fa-lg"
                                                style="color: #fdbf46; font-size:12px; margin-left: 5px;"></i>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <i class="fa-solid fa-star-half-stroke fa-lg"
                                                style="color: #fdbf46; font-size:12px; margin-left: 5px;"></i>
                                        @endif
                                        @for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++)
                                            <i class="fa-regular fa-star fa-lg"
                                                style="color: #ccc; font-size:12px; margin-left: 5px;"></i>
                                        @endfor
                                    </h2>
                                </div>

                                <p class="ms-2">No. of reviews : &nbsp;&nbsp;<span
                                        style="color: #c0b9b9;">{{ $totalReviews }}
                                        Reviews</span></p>
                            </div>

                            <!-- Review Cards -->
                            <div class="review-cards mt-4">
                                @foreach ($reviewData as $index => $reviewSet)
                                    <div class="review-card mb-4 {{ $index >= 3 ? 'd-none' : '' }}">
                                        <hr>
                                        <div class="p-2">
                                            <div class="row m-0">
                                                <div class="col-12">
                                                    <div class="col-md-6">
                                                        <div class="row d-flex justify-content-between text-center">
                                                            <div class="col-md-6 col-12">
                                                                <h5 class="text-start">
                                                                    {{ $reviewSet->title }}
                                                                </h5>
                                                            </div>

                                                            <div class="col-md-6 col-12 d-flex">
                                                                <div>Rating : &nbsp; <span
                                                                        style="color:#40d128;font-size:1.4rem; font-weight:400">{{ $reviewSet->rating }}</span>
                                                                    &nbsp;</div>
                                                                <div class="rating mt-1">
                                                                    @php
                                                                        $fullStars = floor($reviewSet->rating);
                                                                        $hasHalfStar =
                                                                            $reviewSet->rating - $fullStars >= 0.5;
                                                                    @endphp
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $fullStars)
                                                                            <i class="fa-solid fa-star"
                                                                                style="color: #fdbf46; font-size:12px"></i>
                                                                        @elseif ($i == $fullStars + 1 && $hasHalfStar)
                                                                            <i class="fa-solid fa-star-half-stroke"
                                                                                style="color: #fdbf46; font-size:12px"></i>
                                                                        @else
                                                                            <i class="fa-regular fa-star"
                                                                                style="color: #ccc; font-size:12px"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="review-text mt-3" style="font-size: small;color:#1d1d1d">
                                                        {{ $reviewSet->body }}
                                                    </p>
                                                </div>

                                                <div class="d-flex gap-5 text-center mt-4">
                                                    <small class="reviewer-name" style="color: #c3c2c2;">
                                                        {{ $reviewSet->user->name ?? 'Test' }}</small>
                                                    <small class="review-date"
                                                        style="color: #c3c2c2;">{{ $reviewSet->created_at->format('Y-m-d') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Show More Button -->
                            <div class="text-start mt-4">
                                <span id="showMoreLessBtn" class="show-More-btn border-0">Show More</span>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="no-reviews d-flex justify-content-center align-items-center"
                                style="min-height: 200px;">
                                <p class="text-muted">No reviews available for this product.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- about and working hours modal  --}}
                <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="aboutModalLabel">{{ $product->shop->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add your content here -->
                                <p class="quickInfo">{{ $product->shop->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add the modal for "Working Hours" -->
                <div class="modal fade" id="workingHoursModal" tabindex="-1" aria-labelledby="workingHoursModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="workingHoursModalLabel">Timings</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-around text-center">
                                <div class="col-12">
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Monday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['monday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['monday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['monday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['monday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Tuesday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['tuesday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['tuesday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['tuesday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['tuesday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Wednesday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['wednesday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['wednesday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['wednesday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['wednesday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Thursday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['thursday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['thursday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['thursday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['thursday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Friday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['friday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['friday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['friday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['friday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Saturday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['saturday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['saturday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['saturday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['saturday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 pe-3 text-end">
                                            <p class="quickInfo text-nowrap">Sunday</p>
                                        </div>
                                        <div class="col-8 ps-5 text-start">
                                            <p class="quickInfo text-nowrap">:&nbsp;&nbsp;&nbsp;
                                                @if (
                                                    !empty($product->shop->hour['daily_timing']['sunday']['opening']) &&
                                                        !empty($product->shop->hour['daily_timing']['sunday']['closing']))
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['sunday']['opening'])->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $product->shop->hour['daily_timing']['sunday']['closing'])->format('h:i A') }}
                                                @else
                                                    Holiday
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content p-0 border-none">
                            <button type="button"
                                class="btn-close btn-close-sm position-absolute end-0 m-2 text-center d-flex align-items-center"
                                data-bs-dismiss="modal" aria-label="Close"
                                style="z-index: 1050; box-shadow: none; background:#fff !important;">
                                <i class="fa-light fa-xmark" style="font-size: 22px;"></i>
                            </button>
                            <div class="modal-body p-0">
                                <div class="ratio ratio-16x9">
                                    <iframe id="videoFrame" src="" title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Modal -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-0 border-none">
                        <button type="button" class="btn-close btn-close-sm position-absolute end-0 m-2"
                            data-bs-dismiss="modal" aria-label="Close"
                            style="z-index: 1050; font-size: 12px; box-shadow: none;">
                        </button>
                        <div class="modal-body p-0">
                            <div class="ratio ratio-16x9">
                                <iframe id="videoFrame" src="" title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Enquiry Modal -->
            <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="enquiryModalLabel">Get the Best Price for <span
                                    style="color:#ef4444;">”{{ $product->name }}”</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="enquiryFormModal" data-deal-id="{{ $product->id }}"
                                onsubmit="event.preventDefault(); submitEnquiryForm(this);">
                                <div>
                                    <label class="form-label">Name*</label>
                                    <input type="text" class="form-control" name="name" id="name" />
                                </div>
                                <div>
                                    <label class="form-label mt-3">Phone Number*</label>
                                    <input type="text" class="form-control" name="phone" id="phone" />
                                </div>
                                <div>
                                    <label class="form-label mt-3">Email(Optional)</label>
                                    <input type="email" class="form-control" name="email" id="email" />
                                </div>
                                <button type="submit" class="btn btn-danger mt-3 enquiryBtn">Send Enquiry</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Modal -->
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modalContent">
                        <div class="modal-header d-flex align-items-center justify-content-between errorHeading shadow-none mb-2"
                            style="background: #FF0000; color: white;">
                            <h5 class="modal-title" id="errorModalLabel" style="font-size: 28px;">
                                There was an error
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <!-- Error Icon -->
                            <i class="fa-solid fa-circle-exclamation my-4"
                                style="color: rgb(255, 80, 80); font-size: 70px;"></i>
                            <p class="mb-0 errorMagnetSubHeading fw-bold pb-4">
                                We are sorry!
                            </p>
                            <p class="mb-0 errorMagnetSubHeading text-muted fw-bold pb-2">
                                You can reach us on
                            </p>
                            <p class="mb-0 errorMobile pb-4">+65 88941306</p>

                            <!-- Contact Us Button -->
                            <a href="/" class="btn successMagnetButton">
                                <i class="fas fa-arrow m-0-left"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Modal -->
            <div class="modal fade text-center" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modalContent">
                        <div class="modal-header d-flex align-content-center justify-content-between"
                            style="background: green; color: white;">
                            <h5 class="modal-title" id="successModalLabel" style="font-size: 28px;">
                                That's all required!
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="color: white;"></button>
                        </div>
                        <div class="modal-body pt-0">
                            <!-- Success Icon -->
                            <i class="fa-solid fa-circle-check my-5" style="color: #28a745; font-size: 80px;"></i>
                            <p class="mb-0 SuccessMagnetSubHeading pb-4">
                                We will get back to you soon!
                            </p>

                            <!-- Back to Home Button -->
                            <a href="/">
                                <button type="button" class="btn successMagnetButton">Back to Home</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

    </section>
    <script>
        // $(document).ready(function() {
        //     const $showMoreLessBtn = $('#showMoreLessBtn');
        //     const $reviewCards = $('.review-card');

        //     if ($reviewCards.length > 3) {
        //         $showMoreLessBtn.show();

        //         $showMoreLessBtn.on('click', function() {
        //             const isShowMore = $(this).text() === 'Show More';

        //             if (isShowMore) {
        //                 $('.review-card.d-none').removeClass('d-none');
        //                 $(this).text('Show Less');
        //             } else {
        //                 $reviewCards.each(function(index) {
        //                     if (index >= 3) $(this).addClass(
        //                     'd-none');
        //                 });
        //                 $(this).text('Show More');
        //             }
        //         });
        //     } else {
        //         $showMoreLessBtn.hide();
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function() {
            const showMoreLessBtn = document.getElementById('showMoreLessBtn');
            const reviewCards = document.querySelectorAll('.review-card');

            if (showMoreLessBtn) {
                if (reviewCards.length > 3) {
                    showMoreLessBtn.style.display = 'block';

                    showMoreLessBtn.addEventListener('click', function() {
                        const isShowMore = this.textContent === 'Show More';

                        if (isShowMore) {
                            document.querySelectorAll('.review-card.d-none').forEach(function(review) {
                                review.classList.remove('d-none');
                            });
                            this.textContent = 'Show Less';
                        } else {
                            reviewCards.forEach(function(review, index) {
                                if (index >= 3) {
                                    review.classList.add('d-none');
                                }
                            });
                            this.textContent = 'Show More';
                        }
                    });
                } else {
                    showMoreLessBtn.style.display = 'none';
                }
            }
        });



        let hideTimeout;
        let currentlyOpenDropdown = null;

        function showDropdown(socialId) {
            const socialDropdown = document.getElementById(socialId);
            console.log(currentlyOpenDropdown)

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


        function navigateToRoute() {
            window.location.href = '/summary';
        }

        function submitServiceForm(route, method, saveoption = null) {
            const form = document.getElementById('service_form');

            if (saveoption) {
                let hiddenInput = document.getElementById('saveOptionInput');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'saveoption';
                    hiddenInput.id = 'saveOptionInput';
                    form.appendChild(hiddenInput);
                }
                hiddenInput.value = saveoption;
            }

            if (form.checkValidity()) {
                form.action = route;
                form.method = method;
                form.submit();
            } else {
                form.reportValidity();
            }
        }

        // Zoom functionality
        const mainImage = document.querySelector("#main-image");
        const detailsContainer = document.querySelector(".details");
        const thumbnails = document.querySelectorAll(".thumb-img");
        const thumbnailContainer = document.querySelector("#thumbnailContainer");
        const scrollUpBtn = document.querySelector("#scrollUpBtn");
        const scrollDownBtn = document.querySelector("#scrollDownBtn");

        detailsContainer.style.pointerEvents = "none";

        mainImage.addEventListener("mouseenter", () => {
            detailsContainer.style.pointerEvents = "auto";
            detailsContainer.style.border = "1px solid #f5f5f5";
        });


        mainImage.addEventListener("mouseleave", () => {
            detailsContainer.style.pointerEvents = "none";
            detailsContainer.style.border = "none";
        });

        let driftInstance = new Drift(mainImage, {
            paneContainer: detailsContainer,
            inlinePane: 769,
            inlineOffsetY: -85,
            containInline: true,
            hoverBoundingBox: true,
        });

        function checkScrollLimits() {
            scrollUpBtn.disabled = thumbnailContainer.scrollTop === 0;
            scrollDownBtn.disabled =
                thumbnailContainer.scrollTop + thumbnailContainer.clientHeight >=
                thumbnailContainer.scrollHeight;
        }

        function scrollUp() {
            thumbnailContainer.scrollBy({
                top: -80,
                behavior: "smooth",
            });
            setTimeout(checkScrollLimits, 300);
        }

        // Scroll Down Function
        function scrollDown() {
            thumbnailContainer.scrollBy({
                top: 80,
                behavior: "smooth",
            });
            setTimeout(checkScrollLimits, 300);
        }

        checkScrollLimits();

        thumbnails.forEach((thumbnail) => {
            thumbnail.addEventListener("click", (e) => {
                thumbnails.forEach((thumb) => thumb.classList.remove("active"));
                e.target.classList.add("active");

                mainImage.src = e.target.src;
                mainImage.setAttribute("data-zoom", e.target.dataset.zoom);

                driftInstance.destroy();
                driftInstance = new Drift(mainImage, {
                    paneContainer: document.querySelector(".details"),
                    inlinePane: 769,
                    inlineOffsetY: -85,
                    containInline: true,
                    hoverBoundingBox: true,
                });
            });
        });

        function updateVideoModal(videoId) {
            const iframe = document.getElementById('videoFrame');
            iframe.src = `https://www.youtube.com/embed/${videoId}`;
        }

        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
            const iframe = document.getElementById('videoFrame');
            iframe.src = '';
        });
    </script>
    {{-- @push('script')
        <script>
            $(document).ready(function() {
                const showMoreLessBtn = $('#showMoreLessBtn');
                const reviewCards = $('.review-card');

                if (showMoreLessBtn.length) {
                    if (reviewCards.length > 3) {
                        showMoreLessBtn.show();

                        showMoreLessBtn.on('click', function() {
                            const isShowMore = $(this).text() === 'Show More';

                            if (isShowMore) {
                                $('.review-card.d-none').removeClass('d-none');
                                $(this).text('Show Less');
                            } else {
                                reviewCards.each(function(index) {
                                    if (index >= 3) {
                                        $(this).addClass('d-none');
                                    }
                                });
                                $(this).text('Show More');
                            }
                        });
                    } else {
                        showMoreLessBtn.hide();
                    }
                }
            });
        </script>
    @endpush --}}
@endsection
