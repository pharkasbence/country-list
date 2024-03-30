<?php

namespace App\Services\RestCountryApiClient;

use App\Services\Contracts\CountryApiClient;
use App\Services\HttpClient\HttpClient;

class RestCountryApiClient implements CountryApiClient
{
    private $apiBaseUrl;

    public function __construct(private HttpClient $httpClient, private array $config)
    {
        $this->apiBaseUrl = $this->config['base_url'];
    }

    public function getCountries(int $page, int $perPage, array $fields = []): array
    {
        $fieldsQueryParam = $fields ? ['fields' => implode(',', $fields)] : [];
        $queryParams = [
            ...$fieldsQueryParam,
        ];

        $response = $this->httpClient->get($this->apiBaseUrl . '/all', $queryParams);

        // The API does not support pagination, so we need to slice the response array to paginate data
        return array_slice($response, $page * ($perPage - 1), $perPage);
    }
}