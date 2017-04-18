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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/app/news', function (Request $request) {
    $take = $request->get('take',10);
    $news = \App\News::skip($request->get('skip',0))
        ->take($take)->with('category','user')
        ->orderByDesc('created_at')->get();
    return response()->json($news->toArray());
});

Route::post('/app/news/add', function (Request $request) {
    return response()->json($request->toArray());
});
