<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function getAllCities($provinceId)
    {
        $cities = City::where('province_id',$provinceId)->get();
        return response()->json(['cities'=>$cities],200);
    }

    public function getAllProvinces()
    {
        $provinces = Province::all();
        return response()->json(['provinces'=>$provinces],200);
    }
}
