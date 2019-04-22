<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DropdownController extends Controller
{


    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("CountryId",$request->CountryId)
            ->pluck("StateName","StateId");
        return response()->json($states);
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("citys")
            ->where("StateId",$request->StateId)
            ->pluck("CityName","CityId");
        return response()->json($cities);
    }

    public function checkelogmobile(Request $request)
    {
        $user = DB::table('user_infos')->where('MobileNo',$request->mobile)->where('UserId','!=',Auth::user()->id)->first();

        if($user){
            echo "1";
        }else{
            echo "0";
        }
    }
}
