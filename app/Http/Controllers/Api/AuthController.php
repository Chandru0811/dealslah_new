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
use Illuminate\Validation\Rule;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

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
        
        if($role == 3)
        {
            if ($user && Auth::attempt($credentials)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
                $cartnumber = $request->input('cartnumber');
                if($cartnumber == null)
                {
                    $cartnumber = session()->get('cartnumber');
                }
                $customer_cart = Cart::where('customer_id', $user->id)->first();
                $guest_cart = Cart::where('cart_number', $cartnumber)->whereNull('customer_id')->first();
                if($guest_cart && $customer_cart) {
                    foreach ($guest_cart->items as $item) {
                        $existing_item = CartItem::where('cart_id', $customer_cart->id)->where('product_id', $item->product_id)->first();
                        if ($existing_item) {
                            $existing_item->quantity += $item->quantity;
                            $existing_item->save();
                        }else {
                            $item->cart_id = $customer_cart->id;
                            $item->save();
                        }
                    }
            
                    // Update totals in customer cart
                    $customer_cart->item_count += $guest_cart->item_count;
                    $customer_cart->quantity += $guest_cart->quantity;
                    $customer_cart->total += $guest_cart->total;
                    $customer_cart->discount += $guest_cart->discount;
                    $customer_cart->shipping += $guest_cart->shipping;
                    $customer_cart->packaging += $guest_cart->packaging;
                    $customer_cart->handling += $guest_cart->handling;
                    $customer_cart->taxes += $guest_cart->taxes;
                    $customer_cart->grand_total += $guest_cart->grand_total;
                    $customer_cart->shipping_weight += $guest_cart->shipping_weight;
                    $customer_cart->save();
            
                    // Delete the guest cart after merging
                    $guest_cart->delete();
                }
                elseif ($guest_cart) {
                    // If no customer cart exists, assign the guest cart to the user
                    $guest_cart->customer_id = $user->id;
                    $guest_cart->save();
                    $customer_cart = $guest_cart;
                }
        
                session(['cartnumber' => $customer_cart->cart_number ?? $cartnumber]);
                $merged_cart_number = session('cartnumber');
                $success['token'] = $token;
                $success['userDetails'] =  $user;
                $success['cartnumber'] = $merged_cart_number;
                $message = "Welcome {$user->name}, You have successfully logged in. Grab the latest Dealslah offers now!";
    
                return $this->success($message, $success);
            }
        }elseif($role == 2){
            if ($user && Auth::attempt($credentials)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
                $referreralCode = 'DMR500' . $user->id;
                $success['referrer_code'] = $referreralCode;
                $success['token'] = $token;
                $success['userDetails'] =  $user;
    
                $message = 'LoggedIn Successfully!';
    
                return $this->success($message, $success);
            }
        }else{
            if ($user && Auth::attempt($credentials)) {
                $token = $user->createToken('Personal Access Token')->accessToken;
                $success['token'] = $token;
                $success['userDetails'] =  $user;
    
                $message = 'LoggedIn Successfully!';
    
                return $this->success($message, $success);
            }
        }

        

        return $this->error('Invalid email or password. Please check your credentials and try again.,Email.', ['error' => 'Invalid email or password. Please check your credentials and try again.,Email']);
    }

    public function register(Request $request)
    {
        // dd($request->all());
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

        $referrerCode = 'DMR500' . $user->id;

        $token = $user->createToken('Personal Access Token')->accessToken;
        $success['token'] = $token;
        $success['userDetails'] =  $user;
        $success['referrer_code'] = $referrerCode;

        return $this->success('Registered Successfully!', $success);
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
            'street' => 'nullable|string',
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

        $user = User::where('id', $Shop->owner_id)->update(['shop_id' => $Shop->id]);

        return $this->success('Shop Registered Successfully!', $Shop);
    }

    public function logout(Request $request)
    {
        // Get the authenticated user's token
        $token = $request->user()->token();

        // Revoke the token
        $token->revoke();

        return $this->ok('logged Out Successfully!');
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

        $resetLink = "https://dealsmachi.com/dealsmachiVendor/resetpassword?token=" . $token . "&email=" . urlencode($request->email);

        Mail::send('email.forgotPassword', ['resetLink' => $resetLink, 'name' => $username, 'token' => $token], function($message) use($request){
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

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return response()->json(['message' => 'Your password has been changed!']);
    }

    public function verifyAccount($id)
    {
        $user = User::find($id);
        $shop = Shop::where('owner_id',$user->id)->first();
        $product = Product::where('shop_id',$shop->id)->latest()->first();

        if ($user && !$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
            $user->save();

            Mail::to($shop->email)->send(new ProductAddedSuccessfully($shop,$product));

            $adminEmail = 'info@dealslah.com';

            Mail::to($adminEmail)->send(new AdminProductAddedNotification($user, $product));

            return response()->json(['message' => 'Email verified successfully.']);
        }

        return response()->json(['message' => 'User not found or already verified.'], 404);
    }
}
