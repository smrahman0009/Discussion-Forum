<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function auth($provider){

        return Socialite::driver($provider)->redirect();

    }

    public function auth_callback($provider){
        $social_info = Socialite::driver($provider)->user();

        $email = $social_info->getEmail();
        $name = $social_info->getName() != null ? $social_info->getName() : $social_info->getNickname() ;
        $provider_id = $social_info->getId();
        $access_token = $social_info->token;

        $user = User::where(['provider'=>$provider,'provider_id'=>$provider_id])->first();
        
        if(!$user){
            $user = User::create([
                'email' => $email,
                'name' => $name,
                'provider' => $provider,
                'provider_id' => $provider_id,
                'access_token' => $access_token,
            ]);
        }

        Auth::login($user,true);

        return redirect()->home();
        
    }
}
