<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartItemCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cartItemCount = 0;

        if (Auth::check()) {
            $cart = Cart::where('customer_id', Auth::id())->first();
        } else {
            $cart = Cart::where('ip_address', $request->ip())->first();
        }

        if ($cart) {
            $cartItemCount = $cart->items()->count();
        }

        view()->share('cartItemCount', $cartItemCount);

        return $next($request);
    }
}
