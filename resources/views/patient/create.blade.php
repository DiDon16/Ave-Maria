@extends('layouts.template')
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}"/>
@endpush

@section('content')

    <h1>Register New Patient</h1>
    <br>
    @include('patient.form')

@endsection
