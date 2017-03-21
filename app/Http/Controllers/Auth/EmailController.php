<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next) {
            if(isset($request->user()->email)) {
                return redirect($this->redirectTo);
            } else {
                return $next($request);
            }
        });
    }

    public function ask() {
        $user = Auth::user();

        if(!isset($user->email)) {
            return view('auth.email');
        } else {
            return redirect($this->redirectTo);
        }
    }

    public function set(Request $request) {
        $this->validate($request, [
            'email' => 'bail|required|email|unique:users'
        ]);

        $user = Auth::user();

        // TODO: verify that email
        $user->email = $request->email;
        $user->save();


        return redirect($this->redirectTo);
    }
}
