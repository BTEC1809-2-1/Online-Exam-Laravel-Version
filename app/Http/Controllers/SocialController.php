<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite as Socialite;
use App\User;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
Use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return FacadesSocialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = FacadesSocialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
        Auth::login($user);
        return redirect()->to('student');
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'role' => '1',
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
