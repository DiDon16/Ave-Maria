<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PatientRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PatientController extends Controller
{

    public function safeDecrypt($value){
        try {
            return Crypt::decrypt($value);
        } catch (DecryptException $e) {
            //la valeur n'est pas chiffrée
            return $value;
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patients = Patient::all()->map(function ($patient) {
            $patient->firstName = $this->safeDecrypt($patient->firstName);
            $patient->lastName = $this->safeDecrypt($patient->lastName);
            $patient->date_of_birth = $this->safeDecrypt($patient->date_of_birth);
            $patient->gender = $this->safeDecrypt($patient->gender);
            $patient->phone_number = $this->safeDecrypt($patient->phone_number);
            $patient->email = $this->safeDecrypt($patient->email);
            $patient->address = $this->safeDecrypt($patient->address);
            $patient->user_id = $patient->user_id;

            return $patient;
        });

        return view('patient.index', compact('patients'));

        // return view('patient.index', [
        //     'patients' => Patient::select('id', 'lastName', 'firstName', 'gender', 'email', 'phone_number', 'address', 'user_id', 'created_at', 'updated_at')->get(),
        // ]);
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

        $patient = Patient::create([
            'firstName' => Crypt::encrypt($validatedData['firstName']),
            'lastName' => Crypt::encrypt($validatedData['lastName']),
            'date_of_birth' => Crypt::encrypt($validatedData['date_of_birth']),
            'gender' => $validatedData['gender'],
            'phone_number' => Crypt::encrypt($validatedData['phone_number']),
            'email' => Crypt::encrypt($validatedData['email']),
            'address' => Crypt::encrypt($validatedData['address']),
            'user_id' => $validatedData['user_id'],
        ]);

        return redirect()->route('patient.index')->with('success', 'Patient created successfully !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->firstName = $this->safeDecrypt($patient->firstName);
        $patient->lastName = $this->safeDecrypt($patient->lastName);
        $patient->date_of_birth = $this->safeDecrypt($patient->date_of_birth);
        $patient->gender = $this->safeDecrypt($patient->gender);
        $patient->phone_number = $this->safeDecrypt($patient->phone_number);
        $patient->email = $this->safeDecrypt($patient->email);
        $patient->address = $this->safeDecrypt($patient->address);
        $patient->user_id = $patient->user_id;

        return view('patient.show', compact('patient'));
    }


    //  Update Patient Infos
    //  Edit view
    public function edit(Patient $patient){

        $patient->firstName = $this->safeDecrypt($patient->firstName);
        $patient->lastName = $this->safeDecrypt($patient->lastName);
        $patient->date_of_birth = $this->safeDecrypt($patient->date_of_birth);
        $patient->gender = $this->safeDecrypt($patient->gender);
        $patient->phone_number = $this->safeDecrypt($patient->phone_number);
        $patient->email = $this->safeDecrypt($patient->email);
        $patient->address = $this->safeDecrypt($patient->address);
        $patient->user_id = $patient->user_id;

        return view('patient.edit', compact('patient'), [
            'genders' => ['Male', 'Female', 'Other'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $validatedData = $request->validated();

        if(array_key_exists('firstName', $validatedData)){
            $validatedData['firstName'] = Crypt::encrypt($validatedData['firstName']);
        }
        if(array_key_exists('lastName', $validatedData)){
            $validatedData['lastName'] = Crypt::encrypt($validatedData['lastName']);
        }
        if(array_key_exists('date_of_birth', $validatedData)){
            $validatedData['date_of_birth'] = Crypt::encrypt($validatedData['date_of_birth']);
        }
        if(array_key_exists('phone_number', $validatedData)){
            $validatedData['phone_number'] = Crypt::encrypt($validatedData['phone_number']);
        }
        if(array_key_exists('email', $validatedData)){
            $validatedData['email'] = Crypt::encrypt($validatedData['email']);
        }
        if(array_key_exists('address', $validatedData)){
            $validatedData['address'] = Crypt::encrypt($validatedData['address']);
        }

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
