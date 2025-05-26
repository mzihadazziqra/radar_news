<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\MediaStackService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     *
     * @param MediaStackService $mediaStackService
     * @return \Illuminate\View\View
     */
    public function index(MediaStackService $mediaStackService) {
        $mediStackOptions = [
            'limit' => 5,
            'languages' => 'en',
        ];

        $externalHeadlineResult = $mediaStackService->getLatestNews($mediStackOptions);

        $externalHeadlines = [];
        if (isset($externalHeadlineResult['error'])) {

        } else {
            $externalHeadlines = $externalHeadlineResult;
        }

        $localNews = News::with('user', 'category')
                            ->whereNotNull('published_at')
                            ->latest('published_at')
                            ->take(6)
                            ->get();

        return view('welcome', [
            'externalHeadlines' => $externalHeadlines,
            'localNews' => $localNews,
        ]);

    }
}
