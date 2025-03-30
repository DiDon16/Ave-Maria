<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="uft-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha256-YvdLHPgkqJ8DVUxjjnGVlMMJtNimJ6dYkowFFvp4kKs=" crossorigin="anonymous">
        <style>
            @layer demo {
                button {
                    all: unset;
                }

                .navbar-brand{
                    margin-left: 20px;
                }
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="navbar-brand" href="{{ route('index') }}">Ave Maria</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('index') }}">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
              </ul>
            </div>

            <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth

                    <div class="badge bg-secondary " style="font-size:1.3em; margin-right:5px; ">
                        <span>{{ \Illuminate\Support\Facades\Auth::User()->role->name }}</span>
                    </div>

                    <div class="badge bg-secondary" style="color:greenyellow; font-size:1.3em; margin-right:5px;">
                        {{\Illuminate\Support\Facades\Auth::User()->name}}
                    </div>

                    <form class="nav-item" action="{{ route('logout') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="nav-link btn btn-danger" style="color:white;">Logout</button>
                    </form>
                @endauth
                @guest
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                @endguest
            </div>
        </nav>

        <p style="display:block; text-align: center;">
            <img style="width:90%; height:400px; object-fit:cover;" src="/storage/aveMaria/heL5uvtEkoWdlAHkIph7SIG1PZ1TetgnAYtm8pAD.jpg">
        </p>

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>

    </body>
</html>
