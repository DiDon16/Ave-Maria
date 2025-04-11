@extends('layouts.template')
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}"/>
@endpush

@section('content')
    <h1>MRC Analyses</h1>
    <br>
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
