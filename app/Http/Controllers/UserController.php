<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(User $user) {
        return view('pages.user.show')->with('user', $user);
    }
}