<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Socialite;
use App\UserSocial;
use App\User;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Redirect the user to provider authentication page.
     *
     * @param $provider
     */
    public function redirectToProvider($provider) {
        if(config('services.'.$provider) !== null) {
            return Socialite::driver($provider)->redirect();
        } else {
            abort(404);
        }
    }

    /**
     * Obtain the user information from provider
     *
     * @param $provider
     * @return response
     */
    public function handleProviderCallback($provider) {
        if(config('services.'.$provider) === null) {
            abort(404);
        }

        $response = Socialite::driver($provider)->user();

        $providerId = $response->getId();
        $email = $response->getEmail();
        $name = $response->getNickname() !== null ? $response->getNickname() : $response->getName();

        $social = UserSocial::getByProvider($provider, $providerId);
        $user = null;

        if(!isset($social)) {
            $user = isset($email) ? User::where('email', $email)->first() : null;
            if(!isset($email)) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => null
                ]);
            }
            $social = UserSocial::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $providerId
            ]);
        }

        $this->loginBySocial($social, $user);

        if($email === null) {
            return 'Ask for email';
        } else {
            return redirect($this->redirectTo);
        }
    }

    private function loginBySocial($social, $user) {
        if(!isset($user)) {
            $user = $social->user;
        }

        \Auth::login($user);
    }
}
