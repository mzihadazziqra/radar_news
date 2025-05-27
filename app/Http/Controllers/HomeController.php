<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\MediaStackService;
use Illuminate\Support\Facades\Log;

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
            'limit' => 6,
            'languages' => 'en',
        ];

        $externalHeadlineResult = $mediaStackService->getLatestNews($mediStackOptions);

        $externalHeadlines = [];
        if (isset($externalHeadlineResult['error'])) {
            Log::error('MediaStack Error on Homepage: ' . $externalHeadlineResult['error'], ['response' => $externalHeadlineResult]);
        } else {
            $externalHeadlines = $externalHeadlineResult;
        }

        $localNewsPaginated = News::with('user', 'category')
                            ->whereNotNull('published_at')
                            ->latest('published_at')
                            ->paginate(6);


        $heroSlides = News::with('user', 'category')
                            ->whereNotNull('published_at')
                            ->latest('published_at')
                            ->take(3)
                            ->get();

        return view('welcome', [
            'externalHeadlines' => $externalHeadlines,
            'localNewsPaginated' => $localNewsPaginated,
            'heroSlides' => $heroSlides,
        ]);

    }
}
