<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
Use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        return redirect()->route('student');
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = new User();
            $user->id = 'STD'.Carbon::now()->format('Ymdhsi');
            $user->role = '1';
            $user->name = $getInfo->name;
            $user->email = $getInfo->email;
            $user->provider = $provider;
            $user->provider_id = $getInfo->id;
            $user->save();
        }
        return $user;
    }
}
