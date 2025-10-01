<?php

namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ChatSellerController extends Controller
{
    /**
     * Endpoint utama untuk chatbot seller
     */
    public function sendMessage(Request $request): JsonResponse
    {
        // Validasi pesan
        try {
            $this->validateMessage($request);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        $apiKey = $this->getApiKey();
        if (!$apiKey) {
            return response()->json(['error' => '❌ Kunci API tidak ditemukan.'], 500);
        }

        $message = $request->input('message');

        // Kirim ke Gemini API
        $response = $this->sendToGeminiApi($message, $apiKey);

        // Jika error sudah dalam bentuk JsonResponse
        if ($response instanceof JsonResponse) {
            return $response;
        }

        // Proses hasil sukses
        return $this->processApiResponse($response);
    }

    /**
     * Validasi input user
     */
    protected function validateMessage(Request $request): void
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);
    }

    /**
     * Ambil API key dari config/services.php
     */
    protected function getApiKey(): ?string
    {
        $apiKey = config('services.gemini.key');
        if (empty($apiKey)) {
            Log::error('API Key Gemini tidak ditemukan di .env');
            return null;
        }
        return $apiKey;
    }

    /**
     * Kirim request ke Gemini API
     */
    protected function sendToGeminiApi(string $message, string $apiKey)
    {
        $client = new Client([
            'verify' => config('app.env') !== 'local' // kalau lokal bisa nonaktif SSL
        ]);

        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}";

        try {
            return $client->post($apiUrl, [
                'json' => [
                    'systemInstruction' => [
                        'parts' => [
                            ['text' => 'Anda adalah chatbot AI untuk penjual UMKM. Jawablah hanya dalam Bahasa Indonesia dengan sopan, singkat, dan jelas.'],
                        ],
                    ],
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $message]
                            ]
                        ]
                    ]
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
        } catch (RequestException $e) {
            Log::error("❌ Request ke Gemini gagal: " . $e->getMessage());
            if ($e->hasResponse()) {
                $body = $e->getResponse()->getBody()->getContents();
                Log::error("Respons Error Gemini ({$e->getResponse()->getStatusCode()}): " . $body);
            }
            return response()->json(['error' => '⚠️ Gagal koneksi ke Gemini API.'], 500);
        } catch (\Exception $e) {
            Log::error("❌ Error lain: " . $e->getMessage());
            return response()->json(['error' => '⚠️ Terjadi kesalahan server.'], 500);
        }
    }

    /**
     * Proses response dari Gemini
     */
    protected function processApiResponse($response): JsonResponse
    {
        try {
            $body = json_decode($response->getBody()->getContents(), true);

            if (isset($body['candidates'][0]['finishReason']) && $body['candidates'][0]['finishReason'] !== 'STOP') {
                $reason = $body['candidates'][0]['finishReason'];
                Log::warning("❌ Respons diblokir: " . $reason);
                return response()->json(['error' => "Jawaban AI diblokir: {$reason}"], 400);
            }

            $text = $body['candidates'][0]['content']['parts'][0]['text'] 
                ?? "Maaf, AI tidak bisa menjawab.";

            return response()->json(['reply' => $text]);
        } catch (\Exception $e) {
            Log::error("❌ Gagal parsing response: " . $e->getMessage());
            return response()->json(['error' => '⚠️ Error parsing respons API.'], 500);
        }
    }
}
