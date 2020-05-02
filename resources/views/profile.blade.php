@extends('layouts.app')
@section('title', $user->name)

@section('content')
<section class="cover" style="background-image: url({{cover($user->cover)}});">
	<div class="overlay"></div>
	<div class="container-fluid">
		<div class="user">
			<figure>
				@if($user->id == @Auth::user()->id)
				<a href="{{route('users.picture')}}">
					<div>
						<img src="{!! avatar($user->picture,'_lg') !!}">
					</div>
				</a>
				@else
					<img src="{!! avatar($user->picture,'_lg') !!}">
				@endif
			</figure>
			<div class="desc">
				<div class="name">{{$user->name}} {!! $user->verified == 1 ? '<div class="verified" title="Verified"></div>' : '' !!}</div>
				<div class="info">{{"@".$user->username}}</div>
				@if(Auth::check() && $user->id !== @Auth::user()->id)
					<div class="cta-forgif">
					{!! forgifButton($user, '') !!}
					</div>
				@endif
			</div>
		</div>
		@if($user->id == @Auth::user()->id)
		<div class="cta">
			<a href="{{route('users.cover')}}" class="btn btn-primary"><i class="ion ion-edit"></i> Change Cover</a>
		</div>
		@endif
	</div>
</section>

<section>
  <div class="container-fluid">
    <div class="row">
	    <div class="col-md-8 col-md-offset-2">
		    <div class="user-info-group">	    	
			    <div class="user-info">
			    	<div class="user-info-item">
			    		<div>
			    			<div class="name"><a href="{{route('users.detail', $user->username)}}">Posts</a></div>
			    			<div class="value">{{$user->posts}}</div>
			    		</div>
			    	</div>
			    	<div class="user-info-item">
			    		<div>
			    			<div class="name"><a href="{{route('users.forgifings', $user->username)}}">Forgifings</a></div>
			    			<div class="value">{{$user->forgifing}}</div>
			    		</div>
			    	</div>
			    	<div class="user-info-item">
			    		<div>
			    			<div class="name"><a href="{{route('users.forgifers', $user->username)}}">Forgifers</a></div>
			    			<div class="value">{{$user->forgifers}}</div>
			    		</div>
			    	</div>
			    </div>
			    <div class="user-info-bio">
				    @if($user->location)
					    From {!! $user->location !!} - 
				    @endif
			    	{!! bio($user->bio, $user) !!}
			    </div>
		    </div>
	    </div>
		</div>
	  @if(isset($forgifings))
	  	<div class="row">
	  		<div class="col-md-8 col-md-offset-2 col-sm-12">
	  			<div class="panel padding">
		  			<div class="panel-heading">
		  				<h4>Forgifings</h4>
		  			</div>
		  			<div class="panel-body">
			  			@if(!count($forgifings))
				  			<p class="text-center"><i>{{firstname($user->name)}} never forgifing anyone.</i></p>
			  			@else
								<ul class="user-list">
									@foreach($forgifings as $user)
									<li class="friend-list-{{$user->users_from->id}}">
										<figure>
											<a href="{{route('users.detail', $user->users_from->username)}}">
												<img src="{!! avatar($user->users_from->picture, '_md') !!}" alt="{{$user->users_from->name}}">
											</a>
										</figure>
										<div class="desc">
											<div class="name"><a href="{{route('users.detail', $user->users_from->username)}}">{{$user->users_from->name}}</a></div>
											<div class="action">
												{{'@'.$user->users_from->username}}
											</div>
										</div>
									</li>
									@endforeach
								</ul>
								<div class="text-center">
									{!! $forgifings->links() !!}
								</div>
			  			@endif
		  			</div>
	  			</div>
	  		</div>
	  	</div>
	  @elseif(isset($forgifers))
	  	<div class="row">
	  		<div class="col-md-8 col-md-offset-2 col-sm-12">
	  			<div class="panel padding">
		  			<div class="panel-heading">
		  				<h4>Forgifers</h4>
		  			</div>
		  			<div class="panel-body">
			  			@if(!count($forgifers))
				  			<p class="text-center"><i>{{firstname($user->name)}} has no one forgifers.</i></p>
			  			@else
								<ul class="user-list">
									@foreach($forgifers as $user)
									<li class="friend-list-{{$user->users->id}}">
										<figure>
											<a href="{{route('users.detail', $user->users->username)}}">
												<img src="{!! avatar($user->users->picture, '_md') !!}" alt="{{$user->users->name}}">
											</a>
										</figure>
										<div class="desc">
											<div class="name"><a href="{{route('users.detail', $user->users->username)}}">{{$user->users->name}}</a></div>
											<div class="action">
												{{'@'.$user->users->username}}
											</div>
										</div>
									</li>
									@endforeach
								</ul>
								<div class="text-center">
									{!! $forgifers->links() !!}
								</div>
			  			@endif
		  			</div>
	  			</div>
	  		</div>
	  	</div>
	  @else
	    <div class="row">
		    <div class="col-md-8 col-md-offset-2 col-sm-12">
	        @component('parts.element_status')
	        @slot('me', true)
	        @endcomponent
		    </div>
	    </div>
	  @endif
  </div>
</section>
@stop

@section('js')
<script>
getStatus($("[data-status-loader-me]"), '{{$user->id}}');
$(window).scroll(function(){
  if($(window).scrollTop() >= ($(document).height() - $(window).height()) - 100){
    getStatus($("[data-status-loader-me]"), '{{$user->id}}');
  }
});
</script>
@stop