<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    //

    public function viewWeather()
    {
    	return view('check-weather');
    }
}
