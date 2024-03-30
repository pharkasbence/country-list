<?php

namespace App\Services\HttpClient;

use GuzzleHttp\Client;

class HttpClient
{
    public function __construct(private Client $guzzleClient)
    {
        //
    }

    public function get(string $url, array $queryParams, bool $decode = true)
    {
        $response = $this->sendRequest('GET', $url, $queryParams);

        if ($decode) {
            return json_decode($response->getBody(), true);
        }

        return $response->getBody()->getContents();
    }

    public function post(string $url, array $data = [], bool $decode = true)
    {
        $response = $this->sendRequest('POST', $url, ['json' => $data]);

        if ($decode) {
            return json_decode($response->getBody(), true);
        }

        return $response->getBody()->getContents();
    }

    private function sendRequest(string $method, string $url, array $options = [])
    {
        return $this->guzzleClient->request($method, $url, $options);
    }
}