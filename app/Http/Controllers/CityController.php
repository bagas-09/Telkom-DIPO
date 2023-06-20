<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function index()
    {
        $city = array();
        return view('admin.dashboard.city', [
            "title" => "City",
            "city" => City::all(),
        ]);
    }
}
