<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        return view('country.index');
    }
}
