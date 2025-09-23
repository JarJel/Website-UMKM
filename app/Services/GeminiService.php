<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $baseUrl;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.gemini.base_url');
        $this->key = config('services.gemini.key');
        $this->secret = config('services.gemini.secret');
    }

    public function getTicker($symbol = 'btcusd')
    {
        $url = $this->baseUrl . "/pubticker/{$symbol}";
        $response = Http::timeout(30)->get($url); // timeout 30 detik
        return $response->json();
    }

}
