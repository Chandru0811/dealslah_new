<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                Rule::unique(User::class)->where(function ($query) {
                    return $query->where('role', 3);
                }),
            ],
            'password' => 'required|string|min:8|confirmed'
        ]);

        if (User::where('email', $request->email)->where('role', 3)->exists()) {
            return redirect()->back()->withErrors(['email' => 'This email is already taken.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3
        ]);

        event(new Registered($user));

        Auth::login($user);

        $request->session()->regenerate();

        // Assign guest cart to new user if it exists
        $cartnumber = $request->input('cartnumber') ?? session()->get('cartnumber');
        $guest_cart = Cart::where('cart_number', $cartnumber)->whereNull('customer_id')->first();

        if ($guest_cart) {
            $guest_cart->customer_id = $user->id;
            $guest_cart->save();
        }

        session(['cartnumber' => $guest_cart->cart_number ?? $cartnumber]);

        $message = "Welcome {$user->name}, You have successfully registered. \nGrab the latest Dealslah offers now!";

        return redirect()->intended(route('home', ['cartnumber' => session('cartnumber')], false))
            ->with('status', $message);
    }
}
