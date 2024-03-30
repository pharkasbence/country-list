<?php

namespace App\Services\CountryService;

use App\Models\Country;
use App\Services\Contracts\CountryApiClient;
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
        $cacheKey = 'countries:' . md5($page . $perPage . json_encode($fields));

        $result = Cache::remember($cacheKey, $ttl, function () use ($page, $perPage, $fields) {
            return $this->countryApiClient->getCountries($page, $perPage, $fields);
        });

        $countries = collect([]);

        foreach ($result as $countryData) {
            if (in_array('name', $fields)) {
                $countryName = $countryData['name']['common'];
            }

            if (in_array('flag', $fields)) {
                $countryFlag = $countryData['flags']['svg'];
            }

            $country = new Country($countryName ?? null, $countryFlag ?? null);
            
            $countries->push($country);
        }

        return $countries;
    }
}