@extends('layouts.master')

@section('content')
    <div class="container categoryIcons p-3">
        <div class="d-flex justify-content-between mb-3">
            <h3 style="color: #ff0060">
                My Orders
                @if ($orders->isNotEmpty())
                    ({{ $orders->sum(function ($order) {return $order->items->count();}) }})
                @endif
            </h3>
            <a href="/" class="text-decoration-none">
                <button type="button" class="btn showmoreBtn">
                    Shop more
                </button>
            </a>
        </div>
        @if ($orders->isNotEmpty())
            @foreach ($orders as $order)
                @foreach ($order->items as $item)
                    <a class="text-decoration-none"
                        href="{{ url('order', ['id' => $order->id, 'product_id' => $item->product_id]) }}">
                        <div class="card orderCard p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p>
                                    <span class="order-id1">Order Id: {{ $order->order_number ?? 'N/A' }},&nbsp;<span>
                                            <span class="order-id2">Item Id :
                                                {{ $item->item_number ?? 'N/A' }}</span>&nbsp;&nbsp;
                                            <span
                                                class="badge_payment">{{ $order->status === '1'
                                                    ? 'Created'
                                                    : ($order->status === '2'
                                                        ? 'Payment Error'
                                                        : ($order->status === '3'
                                                            ? 'Confirmed'
                                                            : ($order->status === '4'
                                                                ? 'Awaiting Delivery'
                                                                : ($order->status === '5'
                                                                    ? 'Delivered'
                                                                    : ($order->status === '6'
                                                                        ? 'Returned'
                                                                        : ($order->status === '7'
                                                                            ? 'Cancelled'
                                                                            : 'Unknown Status')))))) }}</span>&nbsp;
                                            <span class="badge_warning">
                                                {{ $item->deal_type == 1 ? 'Product' : ($item->deal_type == 2 ? 'Service' : '') }}
                                            </span>
                                </p>
                                <div class="d-flex order-date">
                                    <p>Date : <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                                    </p>
                                    &nbsp;&nbsp;
                                    {{-- <p>Time : <span>{{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}</span></p>
                    --}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-12">
                                        @php
                                            $image = isset($item->product->productMedia)
                                                ? $item->product->productMedia
                                                    ->where('order', 1)
                                                    ->where('type', 'image')
                                                    ->first()
                                                : null;
                                        @endphp
                                        <img src="{{ $image ? asset($image->path) : asset('assets/images/home/noImage.webp') }}"
                                            class="img-fluid" alt="{{ $item->item_description }}" />
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-12">
                                        {{-- <a href="{{ url(path: '/deal/' . $item->product_id) }}" style="color: #000;"
                                            onclick="clickCount('{{ $item->product_id }}')">
                                            <p class="mb-1" style="font-size: 24px;">
                                                {{ $item->item_description ?? 'No Name Available' }}
                                            </p>
                                        </a> --}}
                                        <p class="mb-1" style="font-size: 24px;">
                                            {{ $item->item_description ?? 'No Name Available' }}
                                        </p>
                                        <p class="mb-1 truncated-description">
                                            {{ $item->product->description ?? 'No Description Available' }}
                                        </p>
                                        <div class="d-flex">
                                            @if ($item->deal_type === '1' || $item->deal_type === 'Product')
                                                <p class="mt-1 mb-0">Quantity : {{ $item->quantity }}</p>
                                                &nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if ($item->deal_type === '1' || $item->deal_type === 'Product')
                                                <div class="">
                                                    <img src="{{ asset('assets/images/home/delivery_icon.webp') }}"
                                                        alt="icon" class="img-fluid" />
                                                </div> &nbsp;&nbsp;
                                                <p class="mt-1 mb-0">Delivery Date:
                                                    {{ \Carbon\Carbon::parse($order->created_at)->addDays(5)->format('d/m/Y') ?? 'N/A' }}
                                                </p>
                                            @else
                                            @endif
                                        </div>
                                        <p>
                                            <del>₹{{ number_format($item->unit_price * $item->quantity, 0) }}</del> &nbsp;
                                            <span style="color: #ff0060; font-size:24px">
                                                ₹{{ number_format($item->discount * $item->quantity, 0) }}
                                            </span> &nbsp;
                                            <span class="badge_payment">{{ number_format($item->discount_percent, 0) }}%
                                                saved</span>
                                        </p>
                                        <div class="d-flex justify-content-start align-items-center">
                                            @if ($item->deal_type === '2' || $item->deal_type === 'Product')
                                                <p class="mt-1 mb-0">Service Date : {{ $item->service_date }}</p>
                                            @endif
                                            &nbsp;&nbsp;
                                            @if ($item->deal_type === '2' || $item->deal_type === 'Product')
                                                <p class="mt-1 mb-0">Service Time :
                                                    {{ $item->service_time ? \Carbon\Carbon::parse($item->service_time)->format('h:i A') : 'N/A' }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <span
                                    class="badge_warning">{{ ucfirst(str_replace('_', ' ', $order->payment_type ?? 'N/A')) }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
        @else
            <p>No orders available.</p>
        @endif
    </div>
@endsection
