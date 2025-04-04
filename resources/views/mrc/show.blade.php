@extends('layouts.template')
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}"/>
@endpush

@section('content')
    <h1>MRC Analysis</h1>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Patient</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Colonne de gauche : Informations de base -->
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nom :</strong> {{ $patient->lastName }}
                            </li>
                            <li class="list-group-item">
                                <strong>Prénom :</strong> {{ $patient->firstName }}
                            </li>
                            <li class="list-group-item">
                                <strong>Date de naissance :</strong> {{ $patient->date_of_birth }}
                            </li>
                            <li class="list-group-item">
                                <strong>Genre :</strong> {{ $patient->gender }}
                            </li>
                        </ul>
                    </div>
                    <!-- Colonne de droite : Informations supplémentaires -->
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Téléphone :</strong> {{ $patient->phone_number }}
                            </li>
                            <li class="list-group-item">
                                <strong>Email :</strong> {{ $patient->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>Adresse :</strong> {{ $patient->address }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Analysis data</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Colonne de gauche : Informations de base -->
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Creatinine Level :</strong> {{ $mrcAnalysis->creatinine_level }}
                            </li>
                            <li class="list-group-item">
                                <strong>GFR Level :</strong> {{ $mrcAnalysis->gfr }}
                            </li>
                            <li class="list-group-item">
                                <strong>Albumin Level :</strong> {{ $mrcAnalysis->albumin_level }}
                            </li>
                        </ul>
                        <br>
                    </div>

                    <p style="text-align: center;"><strong>Stage : </strong>{{$mrcAnalysis->stage}}</p>

                </div>

            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                <small>Dernière mise à jour : {{ $mrcAnalysis->updated_at }}</small>
                <small>Enregistré par : {{ $patient->user->name }} - {{ $patient->user->role->name }}</small>
            </div>
        </div>
    </div>

    <!-- Boutons d'actions -->
    <div class="mt-4 text-center">
        <a href="{{ route('patient.mrc.edit', ['mrcAnalysis' => $mrcAnalysis->id]) }}"
            class="btn btn-warning btn-lg me-3">Update Analysis Data
         </a>
        <!-- Bouton pour effectuer une analyse -->
        <a href="{{ route('patient.mrc.create', ['patient' => $patient->id]) }}"
           class="btn btn-success btn-lg me-3">New MRC Analysis
        </a>

        <!-- Bouton pour la prediction du statde de la maladie -->
        @if (!$mrcAnalysis->stage)
            <a href="{{ route('patient.mrc.prediction', ['mrcAnalysis' => $mrcAnalysis->id]) }}"
                class="btn btn-primary btn-lg">Stage prediction
            </a>
        @endif

    </div>
@endsection

