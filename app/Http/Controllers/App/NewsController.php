<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function get(Request $request)
    {
        $take = $request->get('take', 10);
        $news = \App\News::skip($request->get('skip', 0))
            ->take($take)->with('category', 'user')
            ->orderByDesc('created_at')->get();
        return response()->json($news->toArray());
    }

    public function add(Request $request)
    {

    }
}
