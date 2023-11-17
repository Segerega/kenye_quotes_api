<?php

namespace App\Managers;

use App\Services\KanyeRestService;
use Illuminate\Support\Manager;

class QuotesManager extends Manager
{
    protected function createKanyeRestDriver()
    {
        return new KanyeRestService();
    }

    public function getDefaultDriver()
    {
        // You can set the default driver in your config file
        return $this->config->get('quotes.default');
    }
}
