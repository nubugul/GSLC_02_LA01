<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
           $user = Socialite::driver('google')->user();
           dd($user);
           $finduser = User::where('google_id',$user->getId())->first();

           if($finduser)
           {
            Auth::login($finduser);
            return redirect()->intended('dashboard');
           }
           else
           {
            $newuser = User::create([
                'name' => $user->name,
                'username' => $user->email,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => bcrypt('12345678')
            ]);

            Auth::login($newuser);
            return redirect()->intended('dashboard');
           }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
