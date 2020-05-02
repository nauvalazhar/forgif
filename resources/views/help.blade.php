@extends('layouts.app')
@section('title', 'Help Center')
@section('og')
<meta property="og:url" content="{{url('')}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Help Center &mdash; {{config('app.name')}}" />
<meta property="og:description" content="Welcome to the help center, on this page you can 
learn everything about Forgif" />
<meta property="og:image" content="{{url('media/forgif-cover.png')}}" />
<meta property="og:site_name" content="{{config('app.name')}}" />

<meta itemprop="name" content="Help Center &mdash; {{config('app.name')}}">
<meta itemprop="description" content="Welcome to the help center, on this page you can 
learn everything about Forgif">
<meta itemprop="image" content="{{url('media/forgif-cover.png')}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Help Center &mdash; {{config('app.name')}}">
<meta name="twitter:description" content="Welcome to the help center, on this page you can 
learn everything about Forgif">
<meta name="twitter:image:src" content="{{url('media/forgif-cover.png')}}">
@stop

@section('content')
<section class="page primary margin-bottom help" style="background-image: url('{{url('media/help.jpeg')}}');">
	<div class="overlay"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center page-title">
				<h2>Help Center</h2>
				<p class="lead">Welcome to the help center, on this page you can <br>learn everything about Forgif</p>
				<div class="form-search">
					<form method="get" action="{{route('help')}}">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="What can we help?">							
								<div class="input-group-btn">
									<button class="btn btn-default"><i class="ion-search"></i></button>
								</div>
							</div>
							@if(@$q)
							<div class="text-left help-text white">
								Search: {{$q}}
							</div>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page">
	<div class="container-fluid">
		<div class="row">
			@foreach($pages as $page)
			<div class="col-md-3 col-xs-6 col-sm-4">
				<div class="panel padding equal sm round center">
					<div class="panel-heading">
						<h4>{{$page->title}}</h4>
					</div>
					<div class="panel-cta fixed">
						<a href="{{route('pages.view', $page->slug)}}?ref=help">Learn More</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				{!! $pages->links() !!}
			</div>
		</div>
	</div>
</section>
@stop