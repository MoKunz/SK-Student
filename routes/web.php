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

Route::get('/', function () {
    return redirect('/app/activity-day');
})->name('index');

Route::get('/app', function () {
    return redirect('/app/activity-day');
})->name('index');

// App
Route::get('/app/{app?}', function () {
    return view('app.index');
})->name('app')->where('app', '.*');


Route::group(['namespace' => 'App', 'prefix' => 'app-api'], function () {
    Route::get('news', 'NewsController@get');
    Route::post('news/add', 'NewsController@add')->middleware('auth');

    Route::post('account/login', 'AccountController@login');
    Route::post('account/logout', 'AccountController@logout')->middleware('auth');
    Route::post('account/register', 'AccountController@register');
    Route::get('account/current', 'AccountController@current');

    Route::get('activity-day/clubs', 'ActivityDayController@clubs');
    Route::post('activity-day/request-otp', 'ActivityDayController@requestOTP');
    Route::post('activity-day/vote', 'ActivityDayController@vote');
});

Route::group(['prefix' => 'app-content'], function () {
    Route::get('user-media/{mediaID}', 'UserMediaController@get');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
