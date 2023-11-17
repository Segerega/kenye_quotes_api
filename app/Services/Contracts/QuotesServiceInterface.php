<?php
namespace App\Services\Contracts;

interface QuotesServiceInterface
{
    public function getRandomQuotes();

    public function getRandomQuote();
}
