{{-- <form action="" method="POST">
    @csrf

    <div class="mb-3">
        <input id="name" class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Name">
        @error('name')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
        <input id="email" class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="Email">
        @error('email')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
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
        <input id="password" class="form-control" type="password" name="password" placeholder="Password">
        @error('password')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
        <input id="password" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
        @error('password')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary">Submit</button>

</form> --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Register</title>

        {{-- Bootstrap 5 --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha256-jTIdiMuX/e3DGJUGwl3pKSxuc6YOuqtJYkM0bGQESA4=" crossorigin="anonymous">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}" />
    </head>
    <body class="login-page">

        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
                <div class="row align-items-center justify-content-center">

                    <div class="col-md-8 col-lg-7">
                        <div class="login-box bg-white box-shadow border-radius-10">

                            <div class="login-title mt-4">
                                <h2 class="text-center text-dark">Register</h2>
                            </div>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="post">
                                @csrf

                                <div class="mb-4">
                                    <div class="input-group custom" style="margin-bottom:0px;">
                                        <input type="text" class="form-control form-control-lg" name="name" placeholder="Name" value="{{old('name')}}"/>
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                    @error('name')
                                        <div class="form-control-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="input-group custom" style="margin-bottom:0px;">
                                        <input type="text" class="form-control form-control-lg" name="email" placeholder="Email" value="{{old('email')}}"/>
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                                              </svg>
                                            </span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="form-control-feedback text-danger">{{$message}}</div>
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

                                    @error('role_id')
                                        <div class="form-control-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="input-group custom" style="margin-bottom:0px;">
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="**********" />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="form-control-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="input-group custom" style="margin-bottom:0px;">
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="**********" />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="form-control-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="row pb-30"></div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group mb-0">
                                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign Up">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div class="d-flex justify-content-center align-items-center" style="height:;">Or</div>

                            <div class="d-flex justify-content-center align-items-center" style="height:;">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">
                                    Sign In
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('vendors/scripts/core.js')}}"></script>
        <script src="{{asset('vendors/scripts/script.min.js')}}"></script>
        <script src="{{asset('vendors/scripts/process.js')}}"></script>
        <script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
    </body>
</html>
