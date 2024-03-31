<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Services\CountryService\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(private CountryService $countryService)
    {
        //
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);
        $fields = $request->get('fields', 'name,flag');

        $countries = $this->countryService->getCountries(
            $page, 
            $perPage, 
            explode(',', $fields),
        );
        
        return CountryResource::collection($countries);
    }
}
