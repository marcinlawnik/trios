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

    $Trios = App\Trio::all();

    foreach ($Trios as $Trio) {
        echo "<p>".$Trio->sentence1."(".$Trio->explanation1.")"."</p>";
        echo "<p>".$Trio->sentence2."(".$Trio->explanation2.")"."</p>";
        echo "<p>".$Trio->sentence3."(".$Trio->explanation3.")"."</p>";
        echo "<p>".$Trio->answer."</p>";
        echo "<hr>";
    }



//    $trio = Trio::inRandomOrder()->first();
//    $trioText = $trio->sentence1;
//    return view('welcome')->with('time', Carbon::now())->with('trio', $trioText);
});

Route::get('/admin/trios/stats', function () {

    $start_time = microtime(true);
    $triosCount = Trio::all()->count();
    $end_time = microtime(true);
    $Time = $end_time - $start_time;
    $exampleTrios = Trio::orderBy('id', 'desc')->take(10)->get();

    return view('admin.stats')->withTime($Time)->withtrioscount($triosCount)
        ->with('exampleTrios', $exampleTrios);

//    $start_time = microtime(true);
//    $Trios_count = App\Trio::all()->count();
//    echo $Trios_count.'<br>';
//    $end_time = microtime(true);
//    echo $end_time-$start_time;
});
