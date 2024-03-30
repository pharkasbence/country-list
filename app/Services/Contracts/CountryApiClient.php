<?php

namespace App\Services\Contracts;

interface CountryApiClient
{
    function getCountries(int $page, int $perPage, array $fields): array;
}