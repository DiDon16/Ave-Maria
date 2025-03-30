@extends('base')

@section('title', 'Create an account')

@section('content')
<h1>Register</h1>
<br>
<div class="card">
    <div class="card-body">
        <form action="" method="POST">
            @csrf

            <div class="mb-3">
                {{-- <label for="name" class="form-label">Name</label> --}}
                <input id="name" class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Name">
                @error('name')
                    {{ $message }}
                @enderror
            </div>

            <div class="mb-3">
                {{-- <label for="email" class="form-label">Email</label> --}}
                <input id="email" class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                    {{ $message }}
                @enderror
            </div>

            <div class="mb-3">
                {{-- <Label for="role" class="form-label">Role</Label> --}}
                <select id="role" class="form-control" name="role_id">
                    <option value="" placeholder="">Selectionner votre statut</option>
                    @foreach ($roles as $role)
                        <option @selected(old('role_id', $role->role_id) == $role->id) value={{$role->id}}>{{$role->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    {{ $message }}
                @enderror
            </div>

            <div class="mb-3">
                {{-- <label for="password" class="form-label">Password</label> --}}
                <input id="password" class="form-control" type="password" name="password" placeholder="Password">
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <div class="mb-3">
                {{-- <label for="password" class="form-label">Confirm Password</label> --}}
                <input id="password" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <button class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>
@endsection()
