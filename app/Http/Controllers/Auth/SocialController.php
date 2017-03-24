<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use Auth;
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

        $firstTimeLoggedIn = false;

        // Check if user has used this provider for logging in
        if(!isset($userSocial)) {
            // Check if user has logged in before using other provider or normal auth
            // by checking his email
            $user = isset($email) ? User::where('email', $email)->first() : null;
            if(!isset($user)) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => null
                ]);

                $firstTimeLoggedIn = true;
            }
            // Add current provider info to db
            $userSocial = UserSocial::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $providerId
            ]);
        }

        $this->login($userSocial, $user);

        // If user didn't provide email and they are logging for first time, ask for doing that
        if($firstTimeLoggedIn && $email === null) {
            return redirect('/auth/email');
        } else {
            return redirect($this->redirectTo)
                ->with('message', 'Login successful!');
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

        Auth::login($user);
    }
}
