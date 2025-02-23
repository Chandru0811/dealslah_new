<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Auth;
use Illuminate\Support\Str;

class NewCartController extends Controller
{
    public function addtocart(Request $request, $slug)
    {
        $cartnumber = $request->input("cartnumber");
        if($cartnumber == null)
        {
            $cartnumber = session()->get('cartnumber');
        }
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json(['error' => 'Deal not found!'], 404);
        }

        $customer_id = Auth::check() ? Auth::user()->id : null;

        if($customer_id == null)
        {
            if($cartnumber == null)
            {
                $old_cart = null;
                $cartnumber = Str::uuid();
            }else{
                $old_cart = Cart::where('cart_number',$cartnumber)->first();
            }
            
        }else{
            $old_cart = Cart::where('customer_id',$customer_id)->first();
        }

        // Check if the item is already in the cart
        if ($old_cart) {
            $item_in_cart = CartItem::where('cart_id', $old_cart->id)->where('product_id', $product->id)->first();
            if ($item_in_cart && $request->saveoption == "buy now") {
                return redirect()->route('checkout.summary', $product->id);
            } elseif ($item_in_cart) {
                return response()->json(['error' => 'Deal already in cart!'], 400);
            }
        }

        $qtt = $request->quantity;
        if ($qtt == null) {
            $qtt = 1;
        }
        $payment_status = $request->payment_status;
        if ($payment_status == null) {
            $payment_status = 1;
        }

        $grand_total = $product->discounted_price * $qtt + $request->shipping + $request->packaging + $request->handling + $request->taxes;
        $discount = ($product->original_price - $product->discounted_price) * $qtt;

        $cart = $old_cart ?? new Cart;
        $cart->customer_id = $customer_id;
        $cart->cart_number = $cartnumber;
        $cart->ip_address = $request->ip();
        $cart->item_count = $old_cart ? ($old_cart->item_count + 1) : 1;
        $cart->quantity = $old_cart ? ($old_cart->quantity + $qtt) : $qtt;
        $cart->total = $old_cart ? ($old_cart->total + ($product->original_price * $qtt)) : ($product->original_price * $qtt);
        $cart->discount = $old_cart ? ($old_cart->discount + $discount) : $discount;
        $cart->shipping = $old_cart ? ($old_cart->shipping + $request->shipping) : $request->shipping;
        $cart->packaging = $old_cart ? ($old_cart->packaging + $request->packaging) : $request->packaging;
        $cart->handling = $old_cart ? ($old_cart->handling + $request->handling) : $request->handling;
        $cart->taxes = $old_cart ? ($old_cart->taxes + $request->taxes) : $request->taxes;
        $cart->grand_total = $old_cart ? ($old_cart->grand_total + $grand_total) : $grand_total;
        $cart->shipping_weight = $old_cart ? ($old_cart->shipping_weight + $request->shipping_weight) : $request->shipping_weight;
        $cart->save();

        $cart_item = new CartItem;
        $cart_item->cart_id = $cart->id;
        $cart_item->product_id = $product->id;
        $cart_item->item_description = $product->name;
        $cart_item->quantity = $qtt;
        $cart_item->unit_price = $product->original_price;
        $cart_item->delivery_date = $request->delivery_date;
        $cart_item->coupon_code = $product->coupon_code;
        $cart_item->discount = $product->discounted_price;
        $cart_item->discount_percent = $product->discount_percentage;
        $cart_item->seller_id = $product->shop_id;
        $cart_item->deal_type = $product->deal_type;
        $cart_item->service_date = $request->service_date;
        $cart_item->service_time = $request->service_time;
        $cart_item->shipping = $request->shipping;
        $cart_item->packaging = $request->packaging;
        $cart_item->handling = $request->handling;
        $cart_item->taxes = $request->taxes;
        $cart_item->shipping_weight = $request->shipping_weight;
        $cart_item->save();

        session()->put('cartnumber', $cartnumber);

        if ($request->saveoption == "buy now") {
            return redirect()->route('checkout.summary', $product->id);
        } else {
            return response()->json([
                'status' => 'Deal added to cart!',
                'cartItemCount' => $cart->item_count,
                'cart_number' => $cart->cart_number
            ]);
        }

        
    }

    public function index(Request $request)
    {
        $cartnumber = $request->input("cartnumber");
        if($cartnumber == null)
        {
            $cartnumber = session()->get('cartnumber');
        }

        $customer_id = Auth::check() ? Auth::user()->id : null;

        if($customer_id == null)
        {
            $cart = Cart::where('cart_number',$cartnumber);
        }else{
            $cart = Cart::where('customer_id',$customer_id);
        }
        $cart = $cart->first();
        $cart->load(['items.product.shop', 'items.product.productMedia:id,resize_path,order,type,imageable_id']);
        $bookmarkedProducts = [];
        $savedItems = [];
        return view('cart', compact('cart', 'bookmarkedProducts', 'savedItems'));
    }
}
