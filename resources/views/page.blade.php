@extends('layouts.app')
@section('title', $page->title)
@section('og')
<meta property="og:url" content="{{route('pages.view', $page->slug)}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$page->title}}" />
<meta property="og:description" content="{{ strip_tags($page->content) }}." />
<meta property="og:image" content="{{url('media/forgif-cover.png')}}" />
<meta property="og:site_name" content="{{config('app.name')}}" />

<meta itemprop="name" content="{{$page->title}}">
<meta itemprop="description" content="{{ strip_tags($page->content) }}.">
<meta itemprop="image" content="{{url('media/forgif-cover.png')}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{$page->title}}">
<meta name="twitter:description" content="{{strip_tags($page->content)}}.">
<meta name="twitter:image:src" content="{{url('media/forgif-cover.png')}}">
@stop

@section('content')
<section class="page">
	<div class="container-fluid">
		<div class="row">
			{{-- <div class="col-md-3"></div> --}}
			<div class="col-md-10 col-md-offset-1">
				<div class="panel padding">
					@if(isset(request()->ref) == 'help')
						<div class="panel-heading">
							<a href="{{route('help')}}" class="link-icon"><i class="ion ion-ios-arrow-left"></i> Back to Help Center</a>
						</div>
					@endif
					<div class="panel-heading">
						<h4>{{$page->title}}</h4>
					</div>
					<div class="panel-body">
						<ul class="meta">
							<li>{!! $page->created_at->diffForHumans() !!}</li>
							@if(isset($page->updated_at))
							<li>Updated at: {!! $page->updated_at !!}</li>
							@endif
							<li>{!! $page->users->name !!}</li>
						</ul>
						{!! $page->content !!}
					</div>
					<div class="panel-footer grey">
						<h4>You may also read</h4>
						<ul class="square">
							@foreach($pages as $item)
							<li><a href="{{route("pages.view", $item->slug)}}">{{$item->title}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop