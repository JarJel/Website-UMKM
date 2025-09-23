<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;

class GeminiController extends Controller
{
    protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    public function index()
    {
        $ticker = $this->gemini->getTicker(); // BTC/USD
        return view('seller.gemini.index', compact('ticker'));
    }
}
