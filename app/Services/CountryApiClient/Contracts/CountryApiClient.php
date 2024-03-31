<?php

namespace App\Services\CountryApiClient\Contracts;

use App\Services\CountryApiClient\DTO\CountryDTOList;

interface CountryApiClient
{
    function getCountries(int $page, int $perPage, array $fields = []): CountryDTOList;
}