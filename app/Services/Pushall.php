<?php

namespace App\Services;

class Pushall
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
