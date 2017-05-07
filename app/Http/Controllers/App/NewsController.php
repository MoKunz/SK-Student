<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddNews;
use App\Http\Requests\SearchNews;
use App\News;
use App\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function get(Request $request)
    {
        $take = $request->get('take', 10);
        $news = News::skip($request->get('skip', 0))
            ->take($take)->with('user', 'tags')
            ->orderByDesc('created_at')->get();
        return response()->json($news->toArray());
    }

    public function add(AddNews $request)
    {
        $user = \Auth::user();
        $news = new News();
        $news->user_id = $user->id;
        $news->name = $request->get('title');
        $news->slug = str_slug($request->get('title'));
        $news->content = $request->get('content');
        $success = $news->save();
        if ($success)
            foreach ($request->get('tags', []) as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName], ['name' => $tagName, 'description' => '']);
                $news->tags()->attach($tag->id);
            }
        return [
            'success' => $success
        ];
    }

    public function search(SearchNews $request)
    {
        return [
            'success' => true,
            'type' => 'full',
            'result' => []
        ];
    }
}
