@if(isset($me) && $me == true)
<div data-status-loader-me></div>

<div class="text-center">
	<div class="infinite-scroll-loader">
		<img src="{!! url('media/loader.gif') !!}">
	</div>
	<div class="infi-end">
		<h1>
			<i class="ion-images"></i>
		</h1>
		No more posts
	</div>
</div>
@else
<div data-status-loader></div>

<div class="text-center">
	<div class="infinite-scroll-loader">
		<img src="{!! url('media/loader.gif') !!}">
	</div>
	<div class="infi-end">
		<h1>
			<i class="ion-ios-people"></i>
		</h1>
		Add more friends and get more GIFs
		<div class="cta">		
			<a href="{{route('users.friends')}}" class="btn btn-primary">Find Friends</a>
		</div>
	</div>
</div>

@endif