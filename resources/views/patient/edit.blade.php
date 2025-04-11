@extends('layouts.template')
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}"/>
@endpush

@php
    $patientName = $patient->firstName.' '.$patient->lastName;
@endphp

@section('content')
    <h1>Patient Informations Update</h1>
    <br>
    @include('patient.form')
@endsection
