<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleClient;

class PushAll
{
    protected string $url = 'https://pushall.ru/api.php';

    public function __construct(private string $apiKey, private string $id) { }

    public function send(string $title, string $text)
    {
        $data = [
            'type'  => 'self',
            'id'    => $this->id,
            'key'   => $this->apiKey,
            'url'   => route('home'),
            'text'  => $text,
            'title' => $title,
        ];

        $client = new GuzzleClient(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
