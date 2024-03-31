<?php

namespace App\Services\CountryApiClient\RestCountryApiClient;

use App\Services\CountryApiClient\Contracts\CountryApiClient;
use App\Services\CountryApiClient\DTO\CountryDTO;
use App\Services\CountryApiClient\DTO\CountryDTOList;
use App\Services\HttpClient\HttpClient;
use Illuminate\Support\Facades\Cache;

class RestCountryApiClient implements CountryApiClient
{
    private $apiBaseUrl;

    public function __construct(private HttpClient $httpClient, private array $config)
    {
        $this->apiBaseUrl = $this->config['base_url'];
    }

    public function getCountries(int $page, int $perPage, array $fields = []): CountryDTOList
    {
        $fieldsQueryParam = $fields ? ['fields' => implode(',', $fields)] : [];
        $queryParams = [
            ...$fieldsQueryParam,
        ];

        $ttl = 60 * 60;
        $cacheKey = 'restcountries:' . md5(json_encode($fields));

        // cache the API response separately because it does not depend on 
        // page and perPage values since the it does not support pagination
        $response = Cache::remember($cacheKey, $ttl, function () use ($queryParams) {
            return $this->httpClient->get($this->apiBaseUrl . '/all', $queryParams);
        });
   
        $paginatedResponse = array_slice($response, ($page - 1) * $perPage, $perPage);
        
        $countryDTOs = [];
        foreach ($paginatedResponse as $countryData) {
            $countryDTO = CountryDTO::fromArray(
                $this->getCountryData($countryData, $fields)
            );

            array_push($countryDTOs, $countryDTO);
        }
    
        return new CountryDTOList(...$countryDTOs);
    }

    private function getCountryData(array $rawData, array $fields): array
    {
        $data = [];

        foreach ($fields as $field) {
            if ($field == 'name') {
                $data['name'] =  $rawData['name']['common'];
            }

            if ($field == 'flag') {
                $data['flag'] =  $rawData['flags']['svg'];
            }
        }

        return $data;
    }
}