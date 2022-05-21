<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaccinations;
use App\Models\Spot;

class VaccinationSpotController extends Controller
{
    public function getVaccineSpot(){
        $data = Spot::with('vaccination')->get();

        return response()->json([
            $data
        ]);
    }

    public function spotDetail($id){
        $data = Spot::where('id', $id)->firstOrFail();
        return response()->json([
            'date'=> date('Y-m-d'),
            'spot'=> $data,
            'vaccions_count' => 15,
        ]);
    }
}
