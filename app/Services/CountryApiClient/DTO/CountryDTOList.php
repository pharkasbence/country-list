<?php

namespace App\Services\CountryApiClient\DTO;

use ArrayIterator;

class CountryDTOList extends ArrayIterator
{
    public function __construct(CountryDTO ...$countryDTOs)
    {
        parent::__construct($countryDTOs);
    }

    public function current() : CountryDTO
    {
        return parent::current();
    }

    public function offsetGet($offset) : CountryDTO
    {
        return parent::offsetGet($offset);
    }
}