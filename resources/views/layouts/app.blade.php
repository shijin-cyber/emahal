<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-mahal') }}</title>

    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
</head>
<body>
    <div id="loading" style="display: none;">
        <div class="loader" id="loaderImg"></div>
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-top shadow-sm navbar-top-fix">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'E-mahal') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarNotification" class="nav-link dropdown-toggle username-label" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-bell"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right notification-bar" aria-labelledby="navbarNotification">
                                    <x-notification />
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle username-label" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @if(Auth::check())
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-1 navBg pl-0 pr-0">
                        <nav class="nav navbar-toggleable-sm shadow-sm">
                            <div class="navbar flex-column mt-md-0 pt-md-0 p-0 w-100" id="navbarWEX">
                                <a href="{{ route('home') }}" class="nav-link {{Request::is('/') ? 'active' : ''}}"><i class="fa fa-dashboard"> </i><span>Dashboard</span></a>
                                <!-- <a href="" class="nav-link"><i class="fa fa-music" aria-hidden="true"></i><span>Media</span></a>
                                <a href="" class="nav-link"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>Pages</span></a>
                                <a href="" class="nav-link"><i class="fa fa-commenting-o" aria-hidden="true"></i><span>Comments</span></a>
                                <a href="" class="nav-link"><i class="fa fa-paint-brush" aria-hidden="true"></i><span>Appearance</span></a>
                                <a href="" class="nav-link"><i class="fa fa-plug" aria-hidden="true"></i><span>Plugins</span></a> -->
                                <a href="{{ url('customer') }}" class="nav-link {{Request::is('add-customer', 'customer',  'customer-edit.*') ? 'active' : ''}}"><i class="fa fa-user" aria-hidden="true"></i><span>Customer </span></a>
                                <a href="{{ url('scholarships') }}" class="nav-link {{Request::is('scholarships', 'add-scholarship',  'edit-notice.*') ? 'active' : ''}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Scholarship</span></a>
                                <a href="{{url('notices')}}" class="nav-link {{Request::is('notices', 'add-notice', 'edit-notice.*') ? 'active' : ''}}"><i class="fa fa-list-alt" aria-hidden="true"></i><span>Notices</span></a>
                                <a href="{{ url('events') }}" class="nav-link {{Request::is('events', 'add-event', 'edit-event.*') ? 'active' : ''}}"><i class="fa fa-calendar" aria-hidden="true"></i><span>Event</span></a>
                                <a href="{{url('settings')}}" class="nav-link {{Request::is('settings') ? 'active' : ''}}"><i class="fa fa-wrench" aria-hidden="true"></i><span>Settings</span></a>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-10 main-content-container">
            @endif
                        @yield('content')
            @if(Auth::check())
                    </div>
                </div>
            </div>
            @endif
        </main>
    </div>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ajaxStart(function(){
            $("#loading").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#loading").css("display", "none");
        });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
