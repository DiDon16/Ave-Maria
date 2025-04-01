<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'phone_number' => [],
            'email' => ['email'],
            'address' => ['string'],
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function prepareForValidation(){
        $user_id = \Illuminate\Support\Facades\Auth::User()->id;
        $this->merge([
            'user_id' => $user_id,
        ]);
    }

    public function messages() {
        return [
            'gender.in' => "Le genre doit etre l'un des suivant : Male, Female, Other."
        ];
    }
}
