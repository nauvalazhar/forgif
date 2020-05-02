@extends('layouts.app')
@section('title', 'GIF by ' . $status->users->name)
@section('og')
<meta property="og:url" content="{{route('status.view', myenc($status->id))}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="See GIF from {{$status->users->name}}" />
<meta property="og:description" content="{!! $status->content !!}" />
<meta property="og:image" content="{{url('media/thumbs/' . $status->attachment . '.png')}}" />
<meta property="og:site_name" content="{{config('app.name')}}" />

<meta itemprop="name" content="See GIF from {{$status->users->name}}">
<meta itemprop="description" content="{!! $status->content !!}">
<meta itemprop="image" content="{{url('media/thumbs/' . $status->attachment . '.png')}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="See GIF from {{$status->users->name}}">
<meta name="twitter:description" content="{!! $status->content !!}">
<meta name="twitter:image:src" content="{{url('media/thumbs/' . $status->attachment . '.png')}}">
@stop

@section('content')
<section class="settings-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			<div class="card-post" id="gif--id--{{$status->id}}">
				<div class="card-post-detail">
					<div class="user">
						<figure>
							<a href="{{route('users.detail',$status->users->username)}}">
								<img src="{{avatar($status->users->picture)}}">
							</a>
						</figure>
						<div class="user-info">
							<div class="name"><a href="{{route('users.detail', $status->users->username)}}">{{$status->users->name}}</a></div>
							<div class="time">{{$status->date}}</div>
						</div>
					</div>

          @if(Auth::check())
					<div class="buttons">
						<!--<a role="button"><i class="ion-chatbubble"></i> <span>100</span></a>-->
						<a role="button" class="option post--like{{($status->has_like ? ' active': '')}}" data-id="{{$status->id}}"{{($status->has_like ? ' data-unlike="true"':'')}}><i class="ion-heart"></i> <span>{{$status->like_count}}</span></a>
						<div class="options dropdown">
							<a href="#" data-toggle="dropdown"><i class="ion-android-more-vertical"></i></a>
							<ul class="dropdown-menu">	
							@if($status->owner)
								<li><a role="button" class="post--edit" data-id="{{$status->id}}">Edit</a></li>
							@endif
							@if($status->owner || $status->admin)
								<li><a role="button" class="post--delete" data-id="{{$status->id}}">Delete</a></li>
							@endif
							<li><a role="button" class="post--getlink" data-link="{{$status->link}}">Get Link</a></li>

							@if(!$status->owner)			
								<li><a role="button" class="post--report" data-id="{{$status->id}}">Report</a></li>
							@endif
							</ul>
						</div>
					</div>
					@endif
					<div class="caption">
						{!! $status->content !!}
					</div>
				</div>
				@if($status->privacy == 'public')
					<div class="post-badge" title="Public Post">
						<i class="ion-fireball"></i> Public
					</div>
				@endif
				{!! gif($status->attachment) !!}
				</div>
			</div>
		</div>
	</div>
</section>
@stop
