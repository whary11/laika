<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function getCountries()
    {
        return Country::with(['departments.municipality'])->get();
    }
}