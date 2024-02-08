<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Province;

class ProvinceController extends Controller
{
    public function searchProvince(Request $request)
    {
        try {
            $province = Province::where('province_id', $request->id)->first();

            if($province) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Retrieved Successfully',
                    'data' => [
                        'province_id' => $province->province_id,
                        'province' => $province->province
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
