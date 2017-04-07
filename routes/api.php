<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// API routes
Route::group(['prefix' => 'solve'], function () {
        Route::get('{trio}', 'ApiSolveController@getTrio');
        Route::get('{trio}/answer', 'ApiSolveController@getTrioAnswer');
        Route::get('/', 'ApiSolveController@getRandomTrio');
        Route::post('{trio}', 'ApiSolveController@postCheck');
});


Route::post('/report', 'ReportController@create');