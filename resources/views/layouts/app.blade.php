<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing. Just start by signing up for free and start sharing your GIF.">
    <meta name="keyword" content="Forgif, GIF sharing site, free GIF, social networking, social media, funnies GIF">
    @yield('og')
    <link rel="shortcut icon" href="{{url(config('app.icon'))}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') &mdash; {{ config('app.name', 'Forgif') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('scripts/bootstrap-tour/build/css/bootstrap-tour.min.css') }}">
    @yield('css')
</head>
<body>
    <div id="app">
    @if(@$navbar !== false)
        <nav class="navbar navbar-default navbar-static-top {{Auth::check() && (Auth::user()->status == NULL || !Auth::user()->password) ? 'has-topbar' : ''}}">
            @if(Auth::check() && Auth::user()->status == NULL)
            <div class="topbar">
                <div class="container-fluid">
                    <strong>Welcome to {{config('app.name')}}!</strong> You need to activate your account. Please, check your email.
                </div>
            </div>
            @elseif(Auth::check() && !Auth::user()->password)
            <div class="topbar">
                <div class="container-fluid">
                    <strong>Welcome to {{config('app.name')}}!</strong> Just set your password then you can login with your email. <a href="{{route('users.settings')}}">Go to settings</a>.
                </div>
            </div>
            @endif
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <div class="navbar-brand">
                        <a class="logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}<span>.</span></a>
                        <div class="global-loader">                    
                            <img src="{{url('media/loader.gif')}}">
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <form class="navbar-form navbar-left" action="{{route('users.search')}}">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Search" required="">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="ion-search"></i></button>                        
                                </div>                                
                            </div>
                        </div>
                    </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
{{--                             <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ion-ios-bell"></i>
                                </a>
                                <div class="dropdown-menu notif">
                                    <h4 class="title-block">Notifications</h4>
                                    <ul>
                                       <li>
                                           <a href="">
                                               <div class="row">
                                                   <div class="col-md-2">
                                                       <figure>
                                                           <img src="{!!avatar(Auth::user()->picture) !!}">
                                                       </figure>                                                       
                                                   </div>
                                                   <div class="col-md-10">
                                                       <div class="name">Tamvan</div>
                                                       <div class="text">lorem ipsum dolor sit amet, dolor amet si contrequer as sikka sda</div>
                                                       <div class="time">20 Minutes ago</div>
                                                   </div>
                                               </div>
                                           </a>
                                       </li> 
                                    </ul>
                                </div>
                            </li>
 --}}                            <li class="dropdown">
                                <a href="" class="dropdown-toggle{{count(Friends::request()) > 0 ? ' dotme': ''}}" data-toggle="dropdown">
                                    <i class="ion-person-stalker"></i> <span class="text">Forgif Request</span>
                                </a>
                                <div class="dropdown-menu user-menu">
                                    <h4 class="title-block">Forgif Request</h4>
                                    @if(count(Friends::request()))
                                    <ul class="user-list">
                                        @foreach(Friends::request() as $user)
                                        <li class="confirm-list-{{$user->users->id}}">
                                            <figure>
                                                <a href="">
                                                    <img src="{!! avatar($user->users->picture.'_md') !!}" alt="{{$user->users->name}}">
                                                </a>
                                            </figure>
                                            <div class="desc">
                                                <div class="name"><a href="">{{$user->users->name}}</a></div>
                                                <div class="action">
                                                {!! forgifButton($user->users) !!}
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-center"><i>You have no forgif request</i></p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <a href="{{route('users.detail', Auth::user()->username)}}">
                                    <div>{{ firstname(Auth::user()->name) }}</div>
                                    <div class="avatar">
                                        <img src="{{avatar(Auth::user()->picture)}}">
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-gear-b"></i> <span class="text">Options</span></a>
                                <div class="dropdown-menu user-options" role="menu">
                                    <h4 class="title-block">Options</h4>
                                    <ul>
                                        <li><a href="{{ route('users.friends') }}"><i class="ion ion-person"></i> Find Friends</a></li>
                                        @if(isAdmin())
                                        <li><a href="{{ route('report.list') }}"><i class="ion ion-alert-circled"></i> Reports</a></li>
                                        @endif
                                        @if(isAdmin())
                                        <li><a href="{{route('pages')}}"><i class="ion ion-document"></i> Pages</a></li>
                                        @endif
                                        <li><a href="{{route('help')}}"><i class="ion ion-help"></i> Help Center</a></li>
                                        <li><a href="{{ route('users.settings', Auth::user()->username) }}"><i class="ion ion-gear-a"></i> Settings</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="ion ion-log-out"></i> Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>                                        
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
                @if(Auth::check())
                <div class="right-on-mobile">
                    <ul class="nav navbar-nav">
                        <li><a href="{{route('users.detail', Auth::user()->username)}}"><i class="ion-person"></i></a></li>
                    </ul>
                </div>
                @endif
            </div>
        </nav>
    @endif

        @yield('content')

        @if(@$footer !== false)
        <footer class="footer main-footer">
            <div class="copyright">            
                Copyright &copy; {{date('Y')}} {{config('app.name')}}. All Right Reserved.
            </div>
            <ul class="footer-nav">
                <li><a href="{{route('pages.view', 'about')}}">About</a></li>
                <li><a href="{{route('pages.view', 'contact')}}">Contact</a></li>
                <li><a href="{{route('help')}}">Help</a></li>
            </ul>
        </footer>
        @endif
    </div>

    <!-- Scripts -->
    <script>var base_url = '{{url('/')}}', appver = '{{Auth::check() ? md5(Auth::user()->id) : md5(request()->ip)}}';</script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('scripts/autosize/dist/autosize.min.js') }}"></script>
    <script src="{{ asset('scripts/sticky.js') }}"></script>
    <script src="{{ asset('scripts/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('scripts/bootstrap-tour/build/js/bootstrap-tour.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('js')
</body>
</html>
