<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use App\Models\User;

class SocialAuthController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service, SocialAccountService $sv)
    {
        //echo $service. '<hr>';
        //dd(Socialite::driver($service)->user());
        $user = $sv->createOrGetUser(Socialite::driver($service)->user(), $service);
        //$user = Socialite::with ( $service )->user ();

        //auth()->login($user);
        $userData = User::where('id', $user->id)->first();
        if($userData->confirmed == '0' || $userData->activated == '0') {
            return view('front.uconfirm', compact('userData'));
        } else {
            auth()->login($user);
        }
        return redirect()->to('/');
    }
}