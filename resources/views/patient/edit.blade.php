@extends('base')

@php
    $patientName = $patient->firstName.' '.$patient->lastName;
@endphp

@section('title', $patientName)

@section('content')
    <h1>Patient Informations Update</h1>
    <br>
    @include('patient.form')
@endsection
