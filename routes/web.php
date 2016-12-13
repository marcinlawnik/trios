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
    $attributes = $trio->getAttributes();
    foreach ($attributes as $key => $value) {
        echo "{$key}: {$value}<br>";
    }
    echo "<a href='/admin/trios/{$trio->id}/edit'>Edit trio</a>";
    return '';
});


Route::get('/admin/trios/{trio}/edit', function(Trio $trio) {
    $csrf = csrf_field();

    $fillable = $trio->getFillable();
    $attributes = $trio->getAttributes();

    echo "<form action='/admin/trios/{$trio->id}/edit' method='post'>
                {$csrf}";

    foreach ($fillable as $key) {
        echo "<input name='{$key}' type='text' value='{$attributes[$key]}'><br>";
    }
    echo  "<input type='submit'>
            </form>";
    return '';
});

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