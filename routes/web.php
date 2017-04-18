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
    return view('news')->with('news', \App\News::orderByDesc('updated_at')->paginate(5));
})->name('index');
Route::get('/news/{slug}',function ($slug) {
    return view('singlenews')->with('singleNews', App\News::where('slug',$slug)->firstOrFail());
})->name('show-news');
Route::get('/addnews', function () {
    return view('addnews')->with('categories',App\Category::all());
})->name('add-news');
Route::post('/addnews', function (Request $request) {
    Validator::validate();
});

// App
Route::get('/app/{app}', function () {
    return view('app.news.index')->with('news',\App\News::orderByDesc('updated_at')->paginate(10));
})->name('app')->where('app','.*');


Auth::routes();

Route::get('/home', 'HomeController@index');
