<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function socialLogin($socialprovider)
    {
        return Socialite::driver($socialprovider)->redirect();
    }

    public function socailLoginResponse($socialprovider)
    {
        try {
            $user = Socialite::driver($socialprovider)->user();
            $finduser = User::where('auth_provider', $socialprovider)->where('auth_provider_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                $message = "Welcome {$finduser->name}, You have successfully logged in. \nGrab the latest Dealslah offers now!";
                $loggedInUser = $finduser;
            } else {
                $existingUser = User::where('email', $user->email)->first();

                if ($existingUser) {
                    Auth::login($existingUser);
                    $message = "Welcome {$existingUser->name}, You have successfully logged in. \nGrab the latest Dealslah offers now!";
                    $loggedInUser = $existingUser;
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'auth_provider_id' => $user->id,
                        'auth_provider' => $socialprovider,
                        'password' => Hash::make('12345678'),
                    ]);

                    Auth::login($newUser);
                    $message = "Welcome {$newUser->name}, You have successfully registered. \nGrab the latest Dealslah offers now!";
                    $loggedInUser = $newUser;
                }
            }

            $cartnumber = session()->get('cartnumber');
            $existing_cart = Cart::where('customer_id', $loggedInUser->id)->first();
            $guest_cart = $cartnumber ? Cart::where('cart_number', $cartnumber)->whereNull('customer_id')->first() : null;

            if ($existing_cart && $guest_cart) {
                foreach ($guest_cart->items as $item) {
                    $existing_cart_item = CartItem::where('cart_id', $existing_cart->id)
                        ->where('product_id', $item->product_id)
                        ->first();

                    if ($existing_cart_item) {
                        $existing_cart_item->quantity += $item->quantity;
                        $existing_cart_item->save();
                    } else {
                        $item->cart_id = $existing_cart->id;
                        $item->save();
                    }
                }

                // Update totals
                $existing_cart->update([
                    'item_count' => $existing_cart->item_count + $guest_cart->item_count,
                    'quantity' => $existing_cart->quantity + $guest_cart->quantity,
                    'total' => $existing_cart->total + $guest_cart->total,
                    'discount' => $existing_cart->discount + $guest_cart->discount,
                    'shipping' => $existing_cart->shipping + $guest_cart->shipping,
                    'packaging' => $existing_cart->packaging + $guest_cart->packaging,
                    'handling' => $existing_cart->handling + $guest_cart->handling,
                    'taxes' => $existing_cart->taxes + $guest_cart->taxes,
                    'grand_total' => $existing_cart->grand_total + $guest_cart->grand_total,
                    'shipping_weight' => $existing_cart->shipping_weight + $guest_cart->shipping_weight,
                ]);

                $guest_cart->delete();
                $final_cart = $existing_cart;
            } elseif (!$existing_cart) {
                if ($guest_cart) {
                    $guest_cart->update(['customer_id' => $loggedInUser->id]);
                    $final_cart = $guest_cart;
                } else {
                    $final_cart = (object)[
                        'id' => null,
                        'cart_number' => $cartnumber,
                    ];
                }
            } else {
                $final_cart = $existing_cart;
            }

            // Update session cart number
            session(['cartnumber' => $final_cart->cart_number]);

            return redirect()->intended(route('home'))->with('status', $message);
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}
