<?php

namespace App\Http\Controllers;

use App\Country;

use App\Http\Resources\GetCountriesCollection;
use Carbon\Carbon;

class LocationController extends Controller
{
    public function getCountries()
    {
        // $countries = cache()->remember('countries', Carbon::now()->addDays(2), function () {
        //     return Country::get();
        // });

        $countries = Country::get();

        return new GetCountriesCollection($countries);
    }
}
