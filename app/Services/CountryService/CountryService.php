<?php

namespace App\Services\CountryService;

use App\Services\CountryApiClient\Contracts\CountryApiClient;
use Database\Factories\CountryFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CountryService
{
    public function __construct(private CountryApiClient $countryApiClient)
    {
        //
    }

    public function getCountries(int $page, int $perPage, array $fields): Collection
    {
        $ttl = 60 * 60;
        $cacheKey = 'countries:' . md5($page . '_' .  $perPage . '_' . implode(',', $fields));

        $result = Cache::remember($cacheKey, $ttl, function () use ($page, $perPage, $fields) {
            return $this->countryApiClient->getCountries($page, $perPage, $fields);
        });

        $countries = collect([]);

        foreach ($result as $countryDTO) {
            $country = CountryFactory::createFromDTO($countryDTO);

            $countries->push($country);
        }

        return $countries;
    }
}