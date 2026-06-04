<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DapodikService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('DAPODIK_URL', 'http://localhost/dapodik/api');
        $this->apiKey = env('DAPODIK_API_KEY', '');
    }

    public function getSiswaByNisn($nisn)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey
        ])->get($this->baseUrl . '/siswa', ['nisn' => $nisn]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    // Tambah method lain sesuai kebutuhan
}
