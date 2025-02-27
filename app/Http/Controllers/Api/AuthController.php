<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminProductAddedNotification;
use App\Mail\ProductAddedSuccessfully;
use App\Models\Cart;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use ApiResponses;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        $user = User::where('email', $credentials['email'])
            ->where('role', $role)->whereNull('deleted_at')->first();

        if ($request->role == 3) {
            if ($user && Auth::attempt($credentials)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
                $cartnumber = $request->input('cartnumber') ?? session()->get('cartnumber');
                if ($cartnumber) {
                    $guest_cart = Cart::where('cart_number', $cartnumber)->whereNull('customer_id')->first();

                    if ($guest_cart) {
                        $guest_cart->customer_id = $user->id;
                        $guest_cart->save();

                        session(['cartnumber' => $guest_cart->cart_number]);
                    }
                }

                $success['token'] = $token;
                $success['userDetails'] =  $user;
                $success['cartnumber'] = $cartnumber;
                $message = "Welcome {$user->name}, You have successfully logged in. Grab the latest DealsMachi offers now!";
            }
        } elseif ($request->role == 2) {
            if ($user && Auth::attempt($credentials)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
                $referreralCode = 'DLR500' . $user->id;

                $success['referrer_code'] = $referreralCode;
                $success['token'] = $token;
                $success['userDetails'] =  $user;
                $message = 'LoggedIn Successfully!';
            }
        } else {
            if ($user && Auth::attempt($credentials)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
            }

            $success['token'] = $token;
            $success['userDetails'] =  $user;
            $message = 'LoggedIn Successfully!';
        }

        return $this->success($message, $success);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('role', $request->role);
                }),
            ],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'referral_code' => $request->referral_code,
            'type' => $request->type
        ]);

        Auth::login($user);
        $token = $user->createToken('Personal Access Token')->accessToken;
        $success = [
            'token' => $token,
            'userDetails' => $user,
        ];

        if ($request->role == 3) {
            $cartnumber = $request->input('cartnumber') ?? session()->get('cartnumber');
            if ($cartnumber) {
                $guest_cart = Cart::where('cart_number', $cartnumber)->whereNull('customer_id')->first();
                if ($guest_cart) {
                    $guest_cart->customer_id = $user->id;
                    $guest_cart->save();
                    session(['cartnumber' => $guest_cart->cart_number]);
                }
            }
            $success['cartnumber'] = session('cartnumber');
            $message = "Welcome {$user->name}, You have successfully registered. Start shopping with the best deals on DealsMachi!";
        } elseif ($request->role == 2) {
            $success['referrer_code'] = 'DLR500' . $user->id;
            $message = "You have successfully registered!";
        } else {
            $message = 'Registered Successfully!';
        }

        return $this->success($message, $success);
    }

    public function shopregistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:shops,name',
            'company_registeration_no' => 'required|string',
            'legal_name' => 'required|string',
            'slug' => 'required|unique:shops,slug',
            'email' => 'required|email|unique:shops,email,',
            'description' => 'required|string',
            'external_url' => 'nullable',
            'mobile' => 'required|string|unique:shops,mobile',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string'
        ], [
            'name.required' => 'The name field is required.',
            'company_registeration_no.required' => 'The company registeration number field is required.',
            'company_registeration_no.unique' => 'The company registeration number field is unique.',
            'legal_name.required' => 'The legal name field is required.',
            'slug.required' => 'The slug field is required.',
            'slug.unique' => 'The slug must be unique.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email must be unique.',
            'description.required' => 'The description field is required.',
            'external_url.url' => 'The website URL must be a valid URL.',
            'mobile.required' => 'The mobile number  is required.',
            'mobile.unique' => 'Mobile number already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $Shop = Shop::create($request->all());

        User::where('id', $Shop->owner_id)->update(['shop_id' => $Shop->id]);

        return $this->success('Shop Registered Successfully!', $Shop);
    }

    public function logout(Request $request)
    {
        // Get the authenticated user's token
        $token = $request->user()->token();

        // Revoke the token
        $token->revoke();

        return $this->ok('Logged Out Successfully!');
    }

    public function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists'   => 'The email does not exist.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        $username = $user->name;

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );

        $resetLink = "https://dealslah.com/dealslahVendor/resetpassword?token=" . $token . "&email=" . urlencode($request->email);

        Mail::send('email.forgotPassword', ['resetLink' => $resetLink, 'name' => $username, 'token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json(['message' => 'We have e-mailed your password reset link!']);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return response()->json(['message' => 'Invalid Token']);
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return response()->json(['message' => 'Your password has been changed!']);
    }

    public function verifyAccount($id)
    {
        $user = User::find($id);

        $shop = Shop::where('owner_id', $user->id)->first();

        $product = Product::where('shop_id', $shop->id)->latest()->first();

        if ($user && !$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();

            $user->save();

            Mail::to($shop->email)->send(new ProductAddedSuccessfully($shop, $product));

            $adminEmail = 'info@dealslah.com';

            Mail::to($adminEmail)->send(new AdminProductAddedNotification($user, $product));

            return response()->json(['message' => 'Email verified successfully.']);
        }

        return response()->json(['message' => 'User not found or already verified.'], 404);
    }
}
