<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MrcAnalysis;
use Illuminate\Http\Request;
use App\Services\DecryptService;
use Illuminate\Support\Facades\Crypt;
use App\Services\MrcPredictionService;

class MrcController extends Controller
{

    public function index(Request $request){
        $mrcAnalyses = MrcAnalysis::all();
        return view('mrc.index', compact('mrcAnalyses'));
    }


    public function create(Request $request, Patient $patient){
        $mrcAnalysis = New MrcAnalysis();

        return view('mrc.create', [
            'patient' => Crypt::decrypt($patient->firstName),
            'mrcAnalysis' => $mrcAnalysis,
        ]);
    }

    public function store(Request $request, Patient $patient){
        $user = $request->user();
        $patient = $patient;

        $validatedData = $request->validate([
            'creatinine_level' => 'required|decimal:0.00,100.99',
            'gfr' => 'required|decimal:0.00,100.99',
            'albumin_level' => 'required|decimal:0.00,100.99',
        ]);

        $validatedData['patient_id'] = $patient->id;
        $validatedData['user_id'] = $user->id;
        $validatedData['stage'] = Null ;

        $mrcAnalysis = MrcAnalysis::create($validatedData);
        $this->prediction($mrcAnalysis);

        return redirect()->route('patient.show', ['patient' => $patient->id])->with('success', 'Action completed successfully !');
    }

    //  Edit analysis
    public function edit(MrcAnalysis $mrcAnalysis){
        return view('mrc.edit', [
            'mrcAnalysis' => $mrcAnalysis,
        ]);
    }

    //  Update analysis
    public function update(MrcAnalysis $mrcAnalysis, Request $request){
        // $user = $request->user();
        // $patient = $patient;

        $validatedData = $request->validate([
            'creatinine_level' => 'required|decimal:0.00,100.99',
            'gfr' => 'required|decimal:0.00,100.99',
            'albumin_level' => 'required|decimal:0.00,100.99',
        ]);

        $mrcAnalysis->update($validatedData);
        $this->prediction($mrcAnalysis);


        return redirect()->route('patient.mrc.show', ['mrcAnalysis' => $mrcAnalysis->id])->with('success', 'Action completed successfully !');
    }

    //  Show analysis
    public function show(MrcAnalysis $mrcAnalysis, DecryptService $decryptService){
        $patient = $mrcAnalysis->patient;

        $patient->firstName = $decryptService->safeDecrypt($patient->firstName);
        $patient->lastName = $decryptService->safeDecrypt($patient->lastName);
        $patient->date_of_birth = $decryptService->safeDecrypt($patient->date_of_birth);
        $patient->gender = $decryptService->safeDecrypt($patient->gender);
        $patient->phone_number = $decryptService->safeDecrypt($patient->phone_number);
        $patient->email = $decryptService->safeDecrypt($patient->email);
        $patient->address = $decryptService->safeDecrypt($patient->address);
        $patient->user_id = $patient->user_id;

        return view('mrc.show', [
            'mrcAnalysis' => $mrcAnalysis,
            'patient' => $patient,
        ]);
    }

    //  Lunch a prediction
    public function prediction(MrcAnalysis $mrcAnalysis){

        // Appel du service
        $prediction = MrcPredictionService::predict(
            $mrcAnalysis->creatinine_level,
            $mrcAnalysis->gfr,
            $mrcAnalysis->albumin_level
        );

        $mrcAnalysis->stage = $prediction['predicted_stage'];
        $mrcAnalysis->save();

        return redirect()->route('patient.mrc.show', [
            'mrcAnalysis' => $mrcAnalysis,
            'patient' => $mrcAnalysis->patient
        ]);

        // return response()->json($prediction);
    }
}


