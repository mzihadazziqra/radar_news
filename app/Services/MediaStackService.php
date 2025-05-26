<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MediaStackService
{
    protected $apiKey;
    protected $baseUri;

    public function __construct()
    {
        $this->apiKey = config('services.mediastack.api_key');
        $this->baseUri = config('services.mediastack.base_uri');

        if (!$this->apiKey) {
            Log::error('MediaStack API key is not configured');
        }
    }

    /**
     * Mengambil berita terbaru dari MediaStack
     * @param array $options Parameter tambahan seperti limit, categories, countries, dll.
     * @return array hasil berita atau array kosong jika gagal
     */
    public function getLatestNews(array $options = [])
    {
        if (!$this->apiKey) {
            return ['error' => 'API key not configured', 'data' => []];
        }

        $defaultParams = [
            'access_key' => $this->apiKey,
            'limit' => 25,
            'languages' => 'en', // Contoh: Prioritaskan bahasa Indonesia, fallback ke Inggris
            // 'countries' => 'id', // Contoh: Berita dari Indonesia
            // bisa tambahkan parameter lain sesuai dokumentasi MediaStack
        ];

        // Gabungkan parameter default dengan options yang diberikan
        $params = array_merge($defaultParams, $options);

        try {
            // permintaan GET ke endpoint 'news
            $response = Http::baseUrl($this->baseUri)->get('news', $params);

            if ($response->successful()) {
                # jika rsponse suskses (status code 200)
                $data = $response->json();
                // MediaStack mengembalikan data berita dalam array 'data'
                return $data['data'] ?? [];
            } else {
                // jika respons gagal
                Log::error('MediaStack API request failed.', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
                return ['error' => 'API request failed', 'status' => $response->status(), 'data' => []];
            }
        } catch (\Exception $e) {
            Log::error('Exception during MediaSrack API request', [
                'message' => $e->getMessage()
            ]);
            return ['error' => $e-> getMessage(), 'data' => []];
        }
    }
}
