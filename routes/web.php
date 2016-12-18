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
use Illuminate\Http\Request;

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

Route::get('/admin/trios/{trio}', function(Trio $trio) {
    return view('admin.trios.view')->with('trio', $trio);
})->where('trio', '[0-9]+');

Route::get('/admin/trios/{trio}/edit', function(Trio $trio) {
    return view('admin.trios.edit')->with('trio', $trio);
})->where('trio', '[0-9]+');

Route::post('/admin/trios/{trio}/edit', function(Request $request, Trio $trio) {
    $trio->sentence1 = $request->input('sentence1', $trio->sentence1);
    $trio->sentence2 = $request->input('sentence2', $trio->sentence2);
    $trio->sentence3 = $request->input('sentence3', $trio->sentence3);
    $trio->explanation1 = $request->input('explanation1', $trio->explanation1);
    $trio->explanation2 = $request->input('explanation2', $trio->explanation2);
    $trio->explanation3 = $request->input('explanation3', $trio->explanation3);
    $trio->answer = $request->input('answer', $trio->answer);

    $trio->save();
    return redirect("/admin/trios/{$trio->id}");
});

Route::get('/admin/trios/add', function() {
    return view('admin.trios.add');
});

Route::post('/admin/trios/add', function(Request $request) {
    if($request->has(['sentence1', 'sentence2', 'sentence3', 'explanation1',
        'explanation2', 'explanation3', 'answer'])) {
        $trio = new Trio();

        $trio->sentence1 = $request->input('sentence1');
        $trio->sentence2 = $request->input('sentence2');
        $trio->sentence3 = $request->input('sentence3');
        $trio->explanation1 = $request->input('explanation1');
        $trio->explanation2 = $request->input('explanation2');
        $trio->explanation3 = $request->input('explanation3');
        $trio->answer = $request->input('answer');

        $trio->save();

        return redirect("/admin/trios/{$trio->id}");
    } else {
        return view('admin.trios.add')->with('trio', $request->except("_token"));
    }
});