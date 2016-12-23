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

use App\Trio;
use Illuminate\Http\Request;


Route::get('/dev/playground', function() {
    $trio = Trio::inRandomOrder()->first();
    return view('dev.playground')->with('data', $trio);
});

Auth::routes();

Route::get('/', 'HomeController@index');

// Admin panel routes
Route::group(['prefix' => 'admin'], function () {

    Route::get('stats', 'StatsController@index');
    Route::resource('trios', 'TriosController');

});