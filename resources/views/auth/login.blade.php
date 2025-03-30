@extends('base')

@section('title', 'Connexion')

@section('content')
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <h1>Login</h1>
    <br>
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="text" name="email" value={{old('email')}}>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

                <button class="btn btn-primary">Se connecter</button>

            </form>
        </div>
    </div>
@endsection
