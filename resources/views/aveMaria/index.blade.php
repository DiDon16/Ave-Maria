@extends('base')

@section('title', 'Accueil - Ave Maria')

@section('content')
    <h1>Patients</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Registered at</th>
            <th scope="col">last update</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>

        <tbody>

            @php $n = 0; @endphp
            @foreach ($patients as $patient)

                <tr>
                    <th scope="row">{{ $n }}</th>
                    <td>{{ $patient->firstName }}</td>
                    <td>{{$patient->lastName}}</td>
                    <td>{{ $patient->created_at }}</td>
                    <td>{{ $patient->updated_at }}</td>
                    <td>
                        <a href="">view</a>
                        |
                        <a href="">Edit</a>
                        |
                        <a href="">delete</a>
                    </td>
                </tr>
                @php $n++; @endphp
            @endforeach

        </tbody>
      </table>
@endsection
