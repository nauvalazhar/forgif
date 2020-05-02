@extends('layouts.app', ['navbar' => false])
@section('title', 'Reset Password')

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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">E-Mail Address</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        Send Link
                    </button>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            Already have an account? <a href="{{route('login')}}">Login</a>
        </div>
    </div>
</section>
@endsection
