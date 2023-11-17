<?php

namespace Tests\Unit;

use App\Http\Controllers\KanyeQuoteController;
use App\Services\KanyeRestService;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class KanyeRestServiceTest extends TestCase
{
    public function testGetRandomQuote()
    {
        // Create a mock and queue one response.
        $mock = new MockHandler([
            new Response(200, [], json_encode(['quote' => 'I love Kanye'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        // Instantiate the service with the mocked client
        $service = new KanyeRestService($client);
        $quote = $service->getRandomQuote();

        // Assert that the service returned the expected quote.
        $this->assertEquals('I love Kanye', $quote['quote']);
    }

    public function testGetMultipleRandomQuotes()
    {
        // Create a mock and queue multiple responses.
        $mock = new MockHandler([
            new Response(200, [], json_encode(['quote' => 'Quote 1'])),
            new Response(200, [], json_encode(['quote' => 'Quote 2'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new KanyeRestService($client);
        $quotes = $service->getRandomQuotes(2);

        // Assert that the service returned the expected quotes.
        $this->assertCount(2, $quotes);
        $this->assertEquals('Quote 1', $quotes[0]['quote']);
        $this->assertEquals('Quote 2', $quotes[1]['quote']);
    }

    public function testQuotesCaching()
    {
        // Mock Guzzle responses
        $mock = new MockHandler([
            new Response(200, [], json_encode(['quote' => 'Quote 1'])),
            new Response(200, [], json_encode(['quote' => 'Quote 2'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new KanyeRestService($client);

        // First call (should cache the result)
        $firstCallResult = $service->getRandomQuotes(2);
        $this->assertEquals('Quote 1', $firstCallResult[0]['quote']);

        // Second call (should return cached result, not the next mock response)
        $secondCallResult = $service->getRandomQuotes(2);
        $this->assertEquals('Quote 1', $secondCallResult[0]['quote']);

        // Asserting cache has the expected data
        $cacheKey = base64_encode('2');
        $this->assertTrue(Cache::has($cacheKey));
    }

    public function testNextTokenGeneration()
    {
        $controller = new KanyeQuoteController();

        // Simulating two separate calls
        $responseOne = $controller->getMultipleRandomQuotes(5);
        $responseTwo = $controller->getMultipleRandomQuotes(5);

        $nextTokenOne = $responseOne->getData(true)['next'];
        $nextTokenTwo = $responseTwo->getData(true)['next'];

        // Asserting that different tokens are generated
        $this->assertNotEquals($nextTokenOne, $nextTokenTwo);
    }
}
