<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    //  New patient creation
    //  Creation view
    public function create(){

        $patient = New Patient();

        return view('patient.create', [
            'patient' => $patient,
            'genders' => ['Male', 'Female', 'Other'],
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    //  Store new patient
    public function store(PatientRequest $request)
    {
        $validatedData = $request->validated();

        $patient = Patient::create($validatedData);

        return redirect()->route('index')->with('success', 'Patient created successfully !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('patient.show', [
            'patient' => $patient,
        ]);
    }


    //  Update Patient Infos
    //  Edit view
    public function edit(Patient $patient){
        return view('patient.edit', [
            'patient' => $patient,
            'genders' => ['Male', 'Female', 'Other'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $validatedData = $request->validated();
        $patient->update($validatedData);

        return redirect()->route('patient.show', ['patient' => $patient->id])->with('success', 'Patient information has been successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
