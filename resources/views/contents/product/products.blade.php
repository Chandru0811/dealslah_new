<div class="col-md-12 col-lg-9 col-12">
    <div class="row pb-4">
        @if ($deals->isNotEmpty())
            @foreach ($deals as $product)
                <div class="col-md-4 col-lg-3 col-12 mb-3 d-flex justify-content-center align-items-stretch">
                    <a href="{{ url('/deal/' . $product->id) }}" style="text-decoration: none; width: 100%;">
                        <div class="card sub_topCard h-100 d-flex flex-column">
                            <div style="min-height: 50px">
                                <span class="badge trending-badge">TRENDING</span>
                                <img src="{{ asset($product->image_url1) }}" class="img-fluid card-img-top1"
                                    alt="card_image" />
                            </div>
                            <div class="card-body card_section flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="mt-3 d-flex align-items-center justify-content-between">
                                        <h5 class="card-title ps-3">{{ $product->name }}</h5>
                                        <span class="badge mx-3 p-0 trending-bookmark-badge">
                                            @if (count($product->bookmark) === 0)
                                                <form action="{{ route('bookmarks.add', $product->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="bookmark-icon"
                                                        style="border: none; background: none;">
                                                        <i class="fa-regular fa-heart" style="color: #ef4444;"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('bookmarks.remove', $product->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bookmark-icon"
                                                        style="border: none; background: none;">
                                                        <i class="fa-solid fa-heart" style="color: #ef4444;"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        </span>
                                    </div>
                                    <span class="px-3">
                                        <i class="fa-solid fa-star" style="color: #ffc200"></i>
                                        <i class="fa-solid fa-star" style="color: #ffc200"></i>
                                        <i class="fa-solid fa-star" style="color: #ffc200"></i>
                                        <i class="fa-solid fa-star" style="color: #ffc200"></i>
                                        <i class="fa-solid fa-star" style="color: #ffc200"></i>
                                    </span>
                                    <p class="px-3 fw-normal truncated-description">{{ $product->description }}
                                    </p>
                                </div>
                                <div>
                                    <div class="card-divider"></div>
                                    <p class="ps-3 fw-medium d-flex align-items-center justify-content-between"
                                        style="color: #ef4444">
                                        <span>₹{{ $product->discounted_price }}</span>
                                        <span
                                            class="mx-3 px-2 couponBadge">DEALSLAH{{ round($product->discount_percentage) }}</span>
                                    </p>
                                    <div class="card-divider"></div>
                                    <div class="ps-3">
                                        <p>Regular Price</p>
                                        <p><s>₹{{ $product->original_price }}</s></p>
                                    </div>
                                    <div class="card-divider"></div>
                                    <p class="ps-3 fw-medium" style="color: #ef4444; font-weight: 400 !important;">
                                        <i class="fa-solid fa-location-dot"></i>&nbsp;Chennai
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-12 d-flex justify-content-center align-items-center text-center" style="min-height: 60vh;">
                <div class="col-12 col-md-12" style="color: rgb(128, 128, 128);">
                    <h2 class="filteremptytext">Something Awesome is Coming Soon!</h2>
                </div>
            </div>
        @endif
    </div>
</div>
