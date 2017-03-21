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
        $this->middleware('socialProvider');
    }

    /**
     * Redirect the user to provider authentication page.
     *
     * @param $provider
     */
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider
     *
     * @param $provider
     * @return response
     */
    public function handleProviderCallback($provider) {
        $response = Socialite::driver($provider)->user();

        $providerId = $response->getId();
        $email = $response->getEmail();
        $name = $response->getNickname() !== null ? $response->getNickname() : $response->getName();

        $userSocial = UserSocial::getByProvider($provider, $providerId);
        $user = null;

        $firsTimeLoggedIn = false;

        // Check if user used this provider for logging in
        if(!isset($userSocial)) {
            // Check if user have logged in before using other provider or normal auth
            // by checking his email
            $user = isset($email) ? User::where('email', $email)->first() : null;
            if(!isset($user)) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => null
                ]);

                $firsTimeLoggedIn = true;
            }
            // Add current provider info to db
            $userSocial = UserSocial::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $providerId
            ]);
        }

        $this->login($userSocial, $user);

        // If user didn't provide email, ask him for doing that
        if($firsTimeLoggedIn && $email === null) {
            return 'Ask for email';
        } else {
            return redirect($this->redirectTo);
        }
    }

    /**
     * Login using given $user. If it is null, get it from given $userSocial
     *
     * @param UserSocial $userSocial
     * @param User $user
     */
    private function login($userSocial, $user) {
        if(!isset($user)) {
            $user = $userSocial->user;
        }

        \Auth::login($user);
    }
}
