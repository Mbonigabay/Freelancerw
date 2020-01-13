<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato|Merriweather|Sofia" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stl.css') }}" rel="stylesheet">
</head>
<body style="background-color: darkblue;">
{{--/**Nav**/--}}
<nav class="navbar navbar-expand-lg sticky-top"
     style="background: darkblue; opacity: 0.9; box-shadow: 2px 2px 5px darkblue;">

    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('home') }}"
               style="color: white; font-family: 'Sofia', cursive; font-size: 30px;">Freelancerw</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" style="font-family: 'Merriweather', serif;font-size: 20px;">
                <li class="nav-item mr-3">
                    <a href="{{action('jobsController@index')}}" class="nav-link" style="color: white">
                        <i class="fa fa-btn fa-angle-down"></i> Browse Jobs
                    </a>
                </li>
                <li class="nav-item mr-3">
                    <a href="{{action('jobsController@create')}}" class="nav-link" style="color: white">
                        <i class="fa fa-btn fa-plus-circle"></i> Post a Job
                    </a>
                </li>

                @guest
                    <li class="nav-item mr-3">
                        <a class="nav-link" style="color: white" href="{{ route('login') }}"><i
                                    class="fa fa-btn fa-sign-in"></i>{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item mr-3">
                            <a class="nav-link" style="color: white"
                               href="{{ route('register') }}"><i class="fa fa-btn fa-user-plus"></i>{{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown mr-3">
                        <a id="navbarDropdown" style="color: white" class="nav-link dropdown-toggle" href="#"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="far fa-envelope"></i> Messages({{ \App\Message::where('user_to', Auth::user()->id)->where('status' , 'unread')->count() }}) <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{action('MessageController@create')}}" class="nav-link" style="color: white">
                                <i class="fa fa-btn fa-plus-circle"></i>  Compose Message
                            </a>
                            <a href="{{action('MessageController@inbox')}}" class="nav-link" style="color: white">
                                <i class="fas fa-inbox"></i>   Inbox
                            </a>
                            <a href="{{action('MessageController@sent')}}" class="nav-link" style="color: white">
                                <i class="fas fa-arrow-right"></i>  Sent Messages
                            </a>
                            <a href="{{action('MessageController@archived')}}" class="nav-link" style="color: white">
                                <i class="fas fa-archive"></i>  Archived Messages
                            </a>
                        </ul>

                    </li>
                    @if (Auth::user()->role_id == 1)
                        <li class="nav-item dropdown mr-3">
                            <a id="navbarDropdown" style="color: white" class="nav-link dropdown-toggle" href="#"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Admin <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{action('jobsController@index')}}" class="nav-link" style="color: white">
                                    All Jobs
                                </a>
                                <a href="{{action('usersController@index')}}" class="nav-link" style="color: white">
                                    All Users
                                </a>
                                <a href="" class="nav-link" style="color: white">
                                    All Roles
                                </a>
                            </ul>

                        </li>
                    @endif

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" style="color: white" class="nav-link dropdown-toggle"
                           href="/users/{{ Auth::user()->id}}"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>
                   <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                        style="width:32px; height:32px; top:10px; left:10px; border-radius:50%">
                </span>

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" style="color: white; " href="/users/{{ Auth::user()->id}}">
                                <i class="fa fa-btn fa-user"></i> {{ __('My Profile') }}
                            </a>
                            <a class="dropdown-item" style="color: white; " href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-btn fa-sign-out"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>

                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
{{--/**End Nav**/--}}
<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8 pt-5">
    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-white" style=" font-family: 'Merriweather';">Welcome!</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!--register-->
<div class="container-fluid">
    @include('partials.error')
    @include('partials.success')
    <div class="row">
        <div class="container mt--8 pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card shadow border-0" style="background-color: white; color: darkblue">

                        <div class="card-body px-lg-5 py-lg-5">
                            <form autocomplete="off" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: white; color: darkblue"><i class="fas fa-user"></i> </span>
                                        </div>
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" value="{{ old('name') }}" required autofocus placeholder="Name">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: white; color: darkblue"><i class='fas fa-envelope'></i> </span>
                                        </div>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required placeholder="Email">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: white; color: darkblue"><i class="fas fa-lock"></i> </span>
                                        </div>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: white; color: darkblue"><i class="fas fa-lock"></i> </span>
                                        </div>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit"
                                                onMouseOver="this.style.backgroundColor='darkblue'; this.style.color='white'"
                                                onMouseOut="this.style.backgroundColor='white'; this.style.color='darkblue'"
                                                class="btn"
                                                style="background-color: white; color: darkblue;border-radius: 1px; border-color: darkblue;text-decoration: ">
                                            <strong>{{ __('Register') }}</strong>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
