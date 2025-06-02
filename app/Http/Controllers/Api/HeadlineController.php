<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    /**
     * Menampilkan daftar berita internasional dari MediaStack.
     */
    public function index(Request $request)
    {
        // Opsi untuk API MediaStack, klien bisa mengirim parameter 'limit' atau 'page' (untuk offset)
        $limit = $request->input('limit', 10); // Default 10 item jika tidak ada parameter limit
        $page = $request->input('page', 1);     // Default halaman 1
        $offset = ($page - 1) * $limit;

        $options = [
            'limit' => $limit,
            'offset' => $offset,
            // Tambahkan parameter lain yang relevan jika perlu & didukung API key-mu
            // 'countries' => '-id',
            'languages' => 'en',
        ];

        $apiResult = $this->mediaStackService->getLatestNews($options);

        // Data dari MediaStack biasanya sudah dalam format array yang cukup baik.
        // Jika ada error atau data kosong:
        if (isset($apiResult['error'])) {
            Log::error('MediaStack API Error via API Endpoint: ' . $apiResult['error'], ['response' => $apiResult]);
            return response()->json([
                'message' => 'Gagal mengambil berita internasional.',
                'error_detail' => $apiResult['error']
            ], 500); // Atau status code yang sesuai dari API MediaStack jika ada
        }

        if (empty($apiResult)) {
            return response()->json(['data' => [], 'message' => 'Tidak ada berita internasional ditemukan.']);
        }

        // Langsung kembalikan array artikel dari MediaStack
        // API MediaStack biasanya mengembalikan data dalam struktur:
        // { "pagination": { "limit": ..., "offset": ..., "count": ..., "total": ... }, "data": [ {article1}, {article2} ] }
        // Kita ambil bagian 'data' dan 'pagination' jika ada.
        // Service kita saat ini mengembalikan array artikel langsung atau array dengan 'error'.

        // Jika service kita mengembalikan array artikel langsung:
        // return response()->json(['data' => $apiResult]);

        // Jika service kita (MediaStackService::getLatestNews) sudah mengembalikan array dengan key 'data' untuk artikel:
        // (Mari kita asumsikan MediaStackService::getLatestNews sudah mengembalikan array artikel langsung jika sukses)
        return response()->json(['data' => $apiResult]);

        // CATATAN: Untuk konsistensi output JSON yang lebih baik, terutama jika kamu ingin
        // menyamakan struktur dengan output dari NewsResource, kita bisa membuat
        // ExternalNewsResource atau HeadlineResource nanti. Untuk saat ini, kita kirim data mentah dari API.
    }
}
