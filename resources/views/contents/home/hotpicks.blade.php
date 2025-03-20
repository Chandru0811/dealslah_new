<div class="container">
    <h3 class="pt-0 pb-2 h3-styling">Hot Picks</h3>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 pb-3" id="hotpicks">
        @foreach ($hotpicks as $hotpick)
        <div class="col mb-3">
            <a href="{{ url('hotpick/' . $hotpick->slug) }}" style="text-decoration: none;">
                <div class=" topCard card-img-top1 h-100">
                    <div class="card-body p-0" style="min-height: 50px; position: relative;">

                        <img src="{{ asset($hotpick->image_path) }}" class="img-fluid card-img-top"
                            alt="{{ $hotpick->name }}" />
                    </div>

                </div>
                <h2 class="h2-styling">{{ $hotpick->name }}</h2>

            </a>
        </div>
        @endforeach
    </div>
</div>
