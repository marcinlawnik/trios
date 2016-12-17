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

Route::get('/admin/trios/', function () {

    $trios = Trio::all();
   return view('admin.trios')->withTrios($trios);

});

Route::get('/admin/trios/stats', function () {

    $startTime = microtime(true);
    $triosCount = Trio::all()->count();
    $endTime = microtime(true);
    $time = $endTime - $startTime;
    $exampleTrios = Trio::orderBy('id', 'desc')->take(10)->get();

    return view('admin.stats')->withTime($time)->with('triosCount', $triosCount)
        ->with('exampleTrios', $exampleTrios);

});