<?php

namespace App\Http\Controllers;

use App\Services\KanyeRestService;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class KanyeQuoteController extends Controller
{

    /**
     * Fetch a random Kanye West quote.
     */
    public function getRandomQuote()
    {
        /** @var KanyeRestService $quotesService */
        $quotesService = app('quotes')->driver(); // Default driver is 'kanyerest'

        return response()->json($quotesService->getRandomQuote(), 200);
    }

    /**
     * Fetch multiple random quotes.
     */
    public function getMultipleRandomQuotes($count = 5, $next = null)
    {
        /** @var KanyeRestService $quotesService */
        $quotesService = app('quotes')->driver(); // Default driver is 'kanyerest'

        return response()->json(
            [
                $quotesService->getRandomQuotes($count, $next),
                'next' => Str::random(60),
            ], 200);
    }
}
