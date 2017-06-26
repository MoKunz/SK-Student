<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddNews;
use App\Http\Requests\SearchNews;
use App\Media;
use App\News;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function get(Request $request)
    {
        $take = $request->get('take', 10);
        $news = News::skip($request->get('skip', 0))
            ->take($take)->with('user', 'tags', 'media')
            ->orderByDesc('created_at')->get();
        return response()->json($news->toArray());
    }

    public function add(AddNews $request)
    {
        $user = \Auth::user();
        // Store news
        $news = new News();
        $news->user_id = $user->id;
        $news->name = $request->get('title');
        $news->slug = str_slug($request->get('title'));
        $news->content = $request->get('content');
        $success = $news->save();
        // copy file
        $file = $request->file('image');
        $imageFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $imagePath = $file->storeAs(
            'images',
            str_slug(
                Carbon::now()->toDateTimeString() . '_' .
                $imageFileName . '.', '_') .
            '.' .
            $file->getClientOriginalExtension()
        );
        // Save images
        $media = new Media();
        $media->user_id = $user->id;
        $media->name = $imageFileName;
        $media->type = $file->getMimeType();
        $media->url = $imagePath;
        $media->title = $imageFileName;
        $media->alt = '';
        $media->description = '';
        $success &= $media->save();
        if ($success) {
            // assign tag
            foreach ($request->get('tags', []) as $tagName) {
                $tag = Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['name' => $tagName, 'description' => '']
                );
                $news->tags()->attach($tag->id);
            }
            // assign image with news
            $news->media()->attach($media->id);
        }

        return [
            'success' => $success,
            'time' => $news->updated_at,
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
