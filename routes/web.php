<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome')->with('time', Carbon::now());
});

Route::get('/dev/playground', function() {
    $data = ['test' => 'test'];

    return view('dev.playground')->with('data', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
