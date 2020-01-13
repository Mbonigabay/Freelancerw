<nav class="navbar navbar-expand-lg sticky-top"
     style="background: white; opacity: 0.9; box-shadow: 2px 2px 5px darkblue;">

    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('home') }}"
               style="color: darkblue; font-family: 'Sofia', cursive; font-size: 30px;">Freelancerw</a>
            </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" style="font-family: 'Merriweather', serif;font-size: 20px;">
                <li class="nav-item dropdown mr-3">
                    <a id="navbarDropdown" style="color: darkblue" class="nav-link dropdown-toggle" href="#"
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-btn fa-angle-down"></i> Browse <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{action('jobsController@index')}}" class="nav-link" style="color: darkblue">
                            <i class="fas fa-briefcase"></i> Browse Jobs
                        </a>
                        <a href="{{action('usersController@index')}}" class="nav-link" style="color: darkblue">
                            <i class="fas fa-users"></i> Browse User
                        </a>
                    </ul>

                </li>
                <li class="nav-item mr-3">
                    <a href="{{action('jobsController@create')}}" class="nav-link" style="color: darkblue">
                        <i class="fa fa-btn fa-plus-circle"></i> Post a Job
                    </a>
                </li>

                @guest
                    <li class="nav-item mr-3">
                        <a class="nav-link" style="color: darkblue" href="{{ route('login') }}"><i
                                    class="fa fa-btn fa-sign-in"></i>{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item mr-3">
                            <a class="nav-link" style="color: darkblue"
                               href="{{ route('register') }}"><i class="fa fa-btn fa-user-plus"></i>{{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown mr-3">
                        <a id="navbarDropdown" style="color: darkblue" class="nav-link dropdown-toggle" href="#"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="far fa-envelope"></i> Messages({{ \App\Message::where('user_to', Auth::user()->id)->where('status' , 'unread')->count() }}) <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{action('MessageController@create')}}" class="nav-link" style="color: darkblue">
                                <i class="fa fa-btn fa-plus-circle"></i>  Compose Message
                            </a>
                            <a href="{{action('MessageController@inbox')}}" class="nav-link" style="color: darkblue">
                                <i class="fas fa-inbox"></i>   Inbox
                            </a>
                            <a href="{{action('MessageController@sent')}}" class="nav-link" style="color: darkblue">
                                <i class="fas fa-arrow-right"></i>  Sent Messages
                            </a>
                            <a href="{{action('MessageController@archived')}}" class="nav-link" style="color: darkblue">
                                <i class="fas fa-archive"></i>  Archived Messages
                            </a>
                        </ul>

                    </li>
                    @if (Auth::user()->role_id == 1)
                        <li class="nav-item dropdown mr-3">
                        <li class="nav-item mr-3">
                            <a href="{{action('AdminController@index')}}" class="nav-link" style="color: darkblue">
                                <i class="fas fa-user-tie"></i> Admin
                            </a>
                        </li>

                        </li>
                    @endif

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" style="color: darkblue" class="nav-link dropdown-toggle"
                           href="/users/{{ Auth::user()->id}}"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>
                   <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                        style="width:32px; height:32px; top:10px; left:10px; border-radius:50%">
                </span>

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" style="color: darkblue; " href="/users/{{ Auth::user()->id}}">
                                <i class="fa fa-btn fa-user"></i> {{ __('My Profile') }}
                            </a>
                            <a class="dropdown-item" style="color: darkblue; " href="{{ route('logout') }}"
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