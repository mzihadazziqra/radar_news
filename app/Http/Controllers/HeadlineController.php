<?php

namespace App\Http\Controllers;

use App\Services\MediaStackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HeadlineController extends Controller
{
    protected $mediaStackService;

    public function __construct(MediaStackService $mediaStackService)
    {
        $this->mediaStackService = $mediaStackService;
    }

    // Menampilkan daftar berita utama dari MediaStack
    public function index()
    {
        $options = [
            'limit' => 12,
            'languages' => 'en',
            // 'countries' => 'id',
        ];
        $apiResult = $this->mediaStackService->getLatestNews($options);

        $articles = [];
        $apiError = null;

        if (isset($apiResult['error'])) {
            $apiError = 'Gagal mengambil berita internasional' . $apiResult['error'];
            if (isset($apiResult['status'])) {
                $apiError .= ' (Status: ' . $apiResult['status'] . ' )';
            }
            Log::error('MediaStack Error di Headlilne Page: ' . $apiError, ['response' => $apiResult]);
        } else if (empty($apiResult)) {
            $apiError = 'Tidak ada berita internasional yang ditemuka saat ini';
        } else {
            $articles = $apiResult;
        }

        return view('headlines.index', compact('articles', 'apiError'));
    }
}
