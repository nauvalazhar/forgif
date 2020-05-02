@extends('layouts.app', ['navbar' => false])
@section('title', 'Login')
@section('og')
<meta property="og:url" content="{{url('login')}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Let's waste your time in {{config('app.name')}}" />
<meta property="og:description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing." />
<meta property="og:image" content="{{url('media/forgif-cover.png')}}" />
<meta property="og:site_name" content="{{config('app.name')}}" />

<meta itemprop="name" content="Let's waste your time in {{config('app.name')}}">
<meta itemprop="description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing.">
<meta itemprop="image" content="{{url('media/forgif-cover.png')}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Let's waste your time in {{config('app.name')}}">
<meta name="twitter:description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing.">
<meta name="twitter:image:src" content="{{url('media/forgif-cover.png')}}">
@stop

@section('content')
<section class="fs-sec">
    <div class="bg" style="background-image: url({{ url('media/bg.jpg') }});">
        <div class="overlay"></div>
        <div class="caption">
            <h1>Welcome to {{config('app.name')}}</h1>
            <p class="lead">Let's waste your time on some unimportant GIFs here</p>
            <div class="cta">
                <a href="{{ route('help') }}" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">        
            <div class="brand">
                <a href="{{ route('home') }}">
                    <img src="{{url(config('app.logo'))}}" alt="Forgif Logo">
                </a>
            </div>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label fw">Password
                    <div class="pull-right">
                        <a href="{{route('password.request')}}" tabindex="-1">Forgot password?</a>
                    </div>
                    </label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group text-right">
                    <label class="pull-left remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </form>

            <div class="sm-title ocl">or one click login</div>
            <a href="{{url('login/facebook')}}" class="btn btn-facebook btn-block"><i class="ion ion-social-facebook"></i> Login with Facebook</a>
        </div>
        <div class="panel-footer">
            Don't have an account? <a href="{{route('register')}}">Create one</a>
        </div>
    </div>
</section>
@endsection
