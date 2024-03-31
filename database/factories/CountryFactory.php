<?php

namespace Database\Factories;

use App\Models\Country;
use App\Services\CountryApiClient\DTO\CountryDTO;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public static function createFromDTO(CountryDTO $countryDTO): Country
    {
        return new Country(
            $countryDTO->name,
            $countryDTO->flag,
        );
    }
}
