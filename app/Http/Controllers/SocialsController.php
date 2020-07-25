<?php

namespace App\Http\Controllers;

use App\AuthIdentity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialsController extends Controller
{
    public function auth($provider){

        return Socialite::driver($provider)->redirect();

    }

    public function auth_callback($provider){
        $social_info = Socialite::driver($provider)->user();
        $authInfo = new AuthIdentity();
        $user = $authInfo->getUserId($social_info->getId(),$provider);
        // dd($check_user);

        if(!$user){
            $email = $social_info->getEmail();
            $name = $social_info->getName() != null ? $social_info->getName() : $social_info->getNickname() ;
    
            $user = User::create([
                'email' => $email,
                'name' => $name,
            ]);
            $authInfo->newUser($user->id,$social_info->getId(),$provider,$social_info->token);
        }

        Auth::login($user,true);

        return redirect()->home();
        
    }
}
