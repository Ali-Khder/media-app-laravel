<?php

namespace App\Services;

use App\Http\Traits\ResponseTrait;
use GuzzleHttp\Client;

class GifService
{
    use ResponseTrait;

    // nodejs(nestjs) url provider
    private $providerUrl;

    public function __construct()
    {
        $this->providerUrl = "localhost:3000/api/gifs/search";
    }

    public function searchGifs($content, $limit)
    {
        // call api with guzzle
        $client = new Client();
        $promise = $client->requestAsync(
            'GET',
            $this->providerUrl,
            [
                'query' => [
                    'content' => $content ? $content : '1',
                    'limit' => $limit ? $limit : 1
                ],
                'headers' => [ // custom headers
                    'Accept' =>  'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        $response = $promise->wait();
        $resEncoded = json_decode($response->getBody());
        return $this->myresponse(true, "Gifs", $resEncoded);
    }
}
