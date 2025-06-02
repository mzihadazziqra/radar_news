<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $localNews = News::with(['category', 'user'])
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);

        return NewsResource::collection($localNews);
    }

    public function show(News $news) {
        return new NewsResource($news);
    }
}
