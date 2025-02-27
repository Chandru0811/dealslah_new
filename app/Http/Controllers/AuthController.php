<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            $finduser = User::where('auth_provider',$socialprovider)->where('auth_provider_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                $message = "Welcome {$finduser->name}, You have successfully logged in. \nGrab the latest Dealslah offers now!";
            }else{
                $existingUser = User::where('email', $user->email)->first();
                
                if ($existingUser) {
                    Auth::login($existingUser);
                    $message = "Welcome {$finduser->name}, You have successfully logged in. \nGrab the latest Dealslah offers now!";
                }
        
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'auth_provider_id'=> $user->id,
                    'auth_provider' => $socialprovider,
                    'password' => Hash::make('12345678')
                ]);
                
                Auth::login($newUser);
                $message = "Welcome {$newUser->name}, You have successfully registered. \nGrab the latest Dealslah offers now!";
                    
            }
               return redirect()->intended(route('home'))->with('status', $message); 
            } catch (Exception $e) {
                return redirect()->route('home')->with('error', $e->getMessage());
            }

    }
}
