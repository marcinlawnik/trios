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
use App\Trio;

Route::get('/', function () {
    $trio = Trio::inRandomOrder()->first();
    $trioText = $trio->sentence1;
    return view('welcome')->with('time', Carbon::now())->with('trio', $trioText);
});

Route::get('/dev/playground', function() {
    $data = ['test' => 'test'];

    return view('dev.playground')->with('data', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/admin/trios/{id}', function($id) {
    $trio = Trio::findOrFail($id);
    return "ID: {$trio->id}<br>
            Sentence 1: {$trio->sentence1}<br>
            Sentence 2: {$trio->sentence2}<br>
            Sentence 3: {$trio->sentence3}<br>
            Explanation 1: {$trio->explanation1}<br>
            Explanation 2: {$trio->explanation2}<br>
            Explanation 3: {$trio->explanation3}<br>
            Answer: {$trio->answer}<br>
            Creaton time: {$trio->created_at}";
});
