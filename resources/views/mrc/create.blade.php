@extends('layouts.template')
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}"/>
@endpush

@section('content')
    <h1>New MRC Analysis for {{$patient->firstName}}</h1>
    <br>
    @include('mrc.form')
@endsection
