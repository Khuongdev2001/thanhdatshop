<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function getProvince()
    {
        $provinces = DB::table("provinces")->select("province_name","province_id")->get();
        return response()->json(["status" => 200, "data" => $provinces, "message" => null], 200);
    }

    public function getDistrict($provinceId)
    {
        $districts =DB::table("districts")->select("district_name","district_id","province_id")
        ->where("province_id", $provinceId)->get();
        return response()->json(["status" => 200, "data" => $districts, "message" => null], 200);
    }

    public function getCommune($districtId)
    {
        $districts = DB::table("communes")->select("commune_name","commune_id","district_id")
        ->where("district_id", $districtId)->get();
        return response()->json(["status" => 200, "data" => $districts, "message" => null], 200);
    }
}
