<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleClient;

class PushAll
{
    private string $id;
    private string $apiKey;

    protected string $url = 'https://pushall.ru/api.php';

    public function __construct(string $apiKey, string $id)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send(string $title, string $text)
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
