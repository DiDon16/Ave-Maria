@extends('base')

@php
    $patientName = $patient->firstName.' '.$patient->lastName;
@endphp
@section('title', $patientName)

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Patient profil</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Colonne de gauche : Informations de base -->
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Lastname :</strong> {{ $patient->lastName }}
                            </li>
                            <li class="list-group-item">
                                <strong>Firstname :</strong> {{ $patient->firstName }}
                            </li>
                            <li class="list-group-item">
                                <strong>Data of birth :</strong> {{ $patient->date_of_birth }}
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
                                <strong>Phone number :</strong> {{ $patient->phone_number }}
                            </li>
                            <li class="list-group-item">
                                <strong>Email :</strong> {{ $patient->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>Address :</strong> {{ $patient->address }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                <small>Last update : {{ $patient->updated_at }}</small>
                <small>Registered by : {{ $patient->user->name }} - {{ $patient->user->role->name }}</small>
            </div>
        </div>
    </div>

    <!-- Boutons d'actions -->
    <div class="mt-4 text-center">
        <!-- Bouton pour effectuer une analyse -->
        <a href="{{ route('patient.mrc.create', ['patient' => $patient->id]) }}"
           class="btn btn-success btn-lg me-2">MRC Analysis</a>

        <!-- Bouton pour mettre à jour le profil -->
        <a href="{{ route('patient.edit', ['patient' => $patient->id]) }}"
           class="btn btn-primary btn-lg">Update profil</a>
    </div>

    {{-- Liste des analyses MRC pour chaque patient --}}
    @php
        $mrcAnalyses = $patient->mrcAnalyses()->select('id', 'created_at', 'updated_at')->get();
    @endphp
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Patient Analyses</h5>
            </div>
            <div class="card-body">
                <!-- Liste des analyses -->

                <ul class="list-group list-group-flush">
                    <!-- Analyse 1 -->
                    @php $n = 1; @endphp
                    @foreach ($mrcAnalyses as $mrcAnalysis)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">MRC Analyse {{$n}}</h6>
                                <small class="text-muted">Date : {{$mrcAnalysis->created_at}}</small>
                            </div>
                            <div>
                                <!-- Icône pour consulter -->
                                <a href="{{route('patient.mrc.show', ['mrcAnalysis' => $mrcAnalysis->id])}}" class="btn btn-sm btn-outline-primary me-1" title="Consulter">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Icône pour éditer -->
                                <a href="{{route('patient.mrc.edit', ['mrcAnalysis' => $mrcAnalysis->id])}}" class="btn btn-sm btn-outline-warning me-1" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Icône pour lancer une prédiction -->
                                <a href="{{route('patient.mrc.prediction', ['mrcAnalysis' => $mrcAnalysis->id])}}" class="btn btn-sm btn-outline-success" title="Lancer une prédiction">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                            </div>
                        </li>
                        @php $n++; @endphp
                    @endforeach

                </ul>
            </div>
        </div>
    </div>


@endsection
