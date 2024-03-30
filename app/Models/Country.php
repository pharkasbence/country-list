<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function __construct(public ?string $name, public ?string $flag)
    {
        //
    }
}
