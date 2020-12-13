<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleClient;

class PushAll
{
    private $id;
    private $apiKey;

    protected string $url = 'https://pushall.ru/api.php';

    public function __construct($apiKey, $id)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send($title, $text)
    {
        $data = [
            'type'  => 'self',
            'id'    => $this->id,
            'key'   => $this->apiKey,
            'text'  => $text,
            'title' => $title,
        ];

        $client = new GuzzleClient(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);
    }
}
