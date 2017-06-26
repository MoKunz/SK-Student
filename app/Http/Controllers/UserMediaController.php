<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserMediaController extends Controller
{
    public function get($mediaID)
    {
        $media = Media::where('type', 'like', 'image%')
            ->where(function ($query) use ($mediaID) {
                $query->where('id', intval($mediaID))
                    ->orWhere('url', 'like', 'images/' . $mediaID . '.%');
            })->first();
        if ($media && Storage::exists($media->url)) {
            return response(Storage::get($media->url))->header("Content-Type", $media->type);
        } else {
            return response('', 404);
        }
    }
}
