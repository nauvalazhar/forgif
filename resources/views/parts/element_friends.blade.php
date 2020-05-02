@if(count(Friends::mayKnow()) > 0)
<ul class="user-list">
	@foreach(Friends::mayKnow() as $user)
	<li class="friend-list-{{$user->id}}">
		<figure>
			<a href="{{route('users.detail', $user->username)}}">
				<img src="{!! avatar($user->picture, '_md') !!}" alt="{{$user->name}}">
			</a>
		</figure>
		<div class="desc">
			<div class="name"><a href="{{route('users.detail', $user->username)}}">{{$user->name}}</a></div>
			<div class="action">
				{!! forgifButton($user) !!}
			</div>
		</div>
	</li>
	@endforeach
</ul>
@else
<div class="text-center">	
	<i>
		Whooppss! Sorry, no friends found.
	</i>
</div>
@endif