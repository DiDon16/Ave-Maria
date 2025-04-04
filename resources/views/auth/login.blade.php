
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login</title>

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
                                <h2 class="text-center text-dark">Login</h2>
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
                                        <input type="text" class="form-control form-control-lg" name="email" placeholder="Email" value="{{old('email')}}"/>
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                    @error('email')
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
                                <div class="row pb-30">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked disabled id="customCheck1" />
                                            <label class="custom-control-label" for="customCheck1">Remember</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group mb-0">
                                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                        </div>

                                    </div>
                                </div>
                            </form>
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
