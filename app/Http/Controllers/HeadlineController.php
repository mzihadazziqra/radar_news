<?php

namespace App\Http\Controllers;

use App\Services\MediaStackService;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
    protected $mediaStackService;

    public function __construct(MediaStackService $mediaStackService)
    {
        $this->mediaStackService = $mediaStackService;
    }

    // Menampilkan daftar berita utama dari MediaStack
    public function index() {
        $options = [
            'limit' => 10,
            // 'languages' => 'id',
            // 'countries' => 'id',
        ];
        $headLines = $this->mediaStackService->getLatestNews($options);

        if (isset($headLines['error'])) {
            $articles = [];
        } else {
            $articles = $headLines;
        }

        return view('headlines.index', ['articles' => $articles]);
    }
}
