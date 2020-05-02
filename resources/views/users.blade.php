@extends('layouts.app')
@section('title', 'Friends')

@section('content')
<section class="settings-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				<div class="panel padding">
					<div class="panel-heading">
						<h4>Friends</h4>
					</div>
					<div class="panel-body">
	          <ul class="user-list">
	              @foreach($friends as $user)
	              <li id="{{$user->has_follow_waiting ? 'confirm':'search'}}-list-{{$user->id}}">
	                  <figure>
	                      <a href="{{route("users.detail", $user->username)}}">
	                          <img src="{!! avatar($user->picture.'_md') !!}" alt="{{$user->name}}">
	                      </a>
	                  </figure>
	                  <div class="desc">
	                      <div class="name"><a href="{{ route('users.detail', $user->username) }}">{{$user->name}}</a> <div class="post-count">({{$user->post_count}} Posts)</div></div>
	                      <div class="action">
	                      {!! forgifButton($user) !!}
	                      </div>
	                  </div>
	              </li>
	              @endforeach
	          </ul>
					</div>
					<div class="panel-footer text-center">
						{!! $friends->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
