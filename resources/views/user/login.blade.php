<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Icon -->
        <link rel="icon" href="{{ asset('img/logo.png') }}">

        <title>Tracker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!--  Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <!---- CSS ---->
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    
    </head>

    <body class="antialiased">
        
        <div class="login-container">
            <div class="login-form mt-auto mx-auto">
                <div class="justify-content-center d-flex ">
                    <h3 class="display-4 mt-2">Plastic Tracker</h3>
                    <img src="{{ asset('img/logo.png') }}" class="mt-3 ml-2 mt-2" width="50" height="50">
                </div>
                <form action="{{ route('user.userCheck') }}" method="POST" autocomplete="off">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf

                    <div class="form-group">
                        <div class="input-group input-group-lg col-12">
                            <span class="input-group-prepend"><i class="input-group-text fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control input-lg" name="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-lg col-12">
                            <span class="input-group-prepend"><i class="input-group-text fa fa-lock" aria-hidden="true"></i></span>
                            <input type="password" class="form-control input-lg" name="password" placeholder="Password" value="{{ old('password') }}">
                        </div>
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-check pull-left ml-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="exampleRemember">
                        <label class="form-check-label" for="exampleRemember">
                                Remember me
                        </label>
                    </div>

                    <div class="form-group justify-content-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <div class="pull-left mr-2 mb-2">
                        <a href="" class="text-warning">
                            <small>Forgot password?</small>
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}" type="text/javascript"></script> 
    </body>

</html>
