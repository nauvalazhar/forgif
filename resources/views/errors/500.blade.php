@extends('layouts.app')
@section('title', 'Page not Found')

@section('content')
<section>
  <div class="container-fluid">
    <div class="row">
	    <div class="col-md-8 col-md-offset-2 notfound">
		    <div class="icon">	    	
			    <i class="ion-heart-broken"></i>
		    </div>
		    <h1>Something went wrong</h1>
		    <p class="lead">
		    	There was a problem loading this page, contact your administrator
		    </p>
		    <div class="cta">
		    	<a href="{{route('home')}}" class="btn btn-primary btn-lg">Back to Home</a>
		    </div>
	    </div>
	  </div>
	</div>
</section>
@stop