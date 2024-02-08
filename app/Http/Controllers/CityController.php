<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;

class CityController extends Controller
{
    public function searchCity(Request $request)
    {
        try {
            $city = City::where('city_id', $request->id)->first();

            if($city) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Retrieved Successfully',
                    'data' => [
                        'city_id' => $city->city_id,
                        'province_id' => $city->province_id,
                        'province' => $city->province,
                        'type' => $city->type,
                        'city_name' => $city->city_name,
                        'postal_code' => $city->postal_code
                    ]
                ], 200);
            }
            return response()->json([
                'success' => false,
                'error-code' => 404,
                'errors' => 'Data Not Exist',
                'message' => 'Error Has Occured'
            ], 404);
        } catch(Exception $e) {
            report($e);
            return response()->json([
                'error' => 'Error Messsage'
            ]);
        }
    }
}
