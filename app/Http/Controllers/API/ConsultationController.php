<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function makeconsule(Request $request)
    {
        $request->validate([
            'disease_history' => 'required|string|max:255',
            'current_symptoms' => 'required|string|max:255'
        ]);

        $consultation = Consultation::create([
            'disease_history' => $request->disease_history,
            'current_symptoms' => $request->current_symptoms
        ]);

        return  response()->json([
            'id' => $consultation->id,
            'status' => $consultation->status,
            'disease_history' => $consultation->disease_history,
            'current_symptoms' => $consultation->current_symptoms,
            'doctor_notes' => $consultation->doctor_notes,
            'message'=> 'Request Consultation sent successfull'
        ]);
    }
    public function consulecond(Request $request)
    {
        $consultation = Consultation::all();

        return  response()->json([
            'data' => $consultation
        ]);
    }
}
