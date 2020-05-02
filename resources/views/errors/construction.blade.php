@extends('layouts.app')
@section('title', 'Page not Found')

@section('content')
<section>
  <div class="container-fluid">
    <div class="row">
	    <div class="col-md-8 col-md-offset-2 notfound">
		    <div class="icon">	    	
			    <i class="ion-code-working"></i>
		    </div>
		    <h1>Page is Under Construction</h1>
		    <p class="lead">
		    	The page you are looking for is under construction
		    </p>
		    <div class="cta">
		    	<a href="{{route('home')}}" class="btn btn-primary btn-lg">Back to Home</a>
		    </div>
	    </div>
	  </div>
	</div>
</section>
@stop