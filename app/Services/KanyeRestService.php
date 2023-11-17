<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Services\Contracts\QuotesServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KanyeRestService implements QuotesServiceInterface
{
    protected $apiUrl = 'https://api.kanye.rest';
    protected ?Client $client;
    const ERROR_RESPONSE = ['error' => 'Failed to fetch quote'];

    /**
     * @param ?Client $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function getRandomQuote()
    {
        return $this->fetchQuote();
    }

    /**
     * @param int $count
     * @return array
     */
    public function getRandomQuotes(int $count = 5, ?string $next = null): array
    {
        // Define a unique cache key
        $cacheKey = base64_encode($count . $next);

        // Check if the cache already has the quote
        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($count) {
            $quotes = [];
            for ($i = 0; $i < $count; $i++) {
                $quoteResult = $this->fetchQuote();

                $quotes[] = $quoteResult;
            }

            return $quotes;
        });

    }

    /**
     * @return mixed
     * @throws \Exception|GuzzleException
     */
    private function fetchQuote()
    {
        try {

            $response = $this->client->request('GET', $this->apiUrl);
            $quoteResult = json_decode($response->getBody()->getContents(), true);

            if (!isset($quoteResult['quote'])) {
                throw new \Exception("Missed quote in the response");
            }

            return $quoteResult;

        } catch (GuzzleException $e) {
            Log::error('Error fetching quote: ' . ErrorCodes::getErrorMessage(ErrorCodes::ERROR_API_CONNECTION_FAILED));
            throw new CustomException(ErrorCodes::ERROR_API_CONNECTION_FAILED, $e->getCode(), $e);
        } catch (\Exception $e) {
            Log::error('Invalid API response: ' . ErrorCodes::getErrorMessage(ErrorCodes::ERROR_API_RESPONSE_INVALID));
            throw new CustomException(ErrorCodes::ERROR_API_RESPONSE_INVALID, $e->getCode(), $e);
        }
    }
}
