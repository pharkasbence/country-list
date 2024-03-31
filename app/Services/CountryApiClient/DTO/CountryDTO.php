<?php

namespace App\Services\CountryApiClient\DTO;

use Illuminate\Support\Facades\Validator;

class CountryDTO
{
    private function __construct(public string $name, public string $flag)
    {
        //
    }

    public static function fromArray(array $data)
    {
        self::validate($data);

        return new static(
            $data['name'],
            $data['flag'],
        );
    }

    public static function rules()
    {
        return [
            'name' => 'required|string',
            'flag' => 'required|url',
        ];
    }

    private static function validate(array $data): void
    {
        $validator = Validator::make($data, self::rules());

        $validator->validate();
    }
}