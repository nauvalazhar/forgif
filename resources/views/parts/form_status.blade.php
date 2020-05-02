<form action="{{ route('status.post') }}" method="post" enctype="multipart/form-data" id="form-status">
	@if(!Auth::check())
		<div class="overlay--auth">
			<div class="icon">			
				<i class="ion-log-in"></i>
			</div>
			You need to <a href="{{route('login')}}">login</a> or <a href="{{route('register')}}">register</a><br>to share your GIF
		</div>
	@endif
	<figure>
		<img src="{{avatar(@Auth::user()->picture)}}">
	</figure>
	<div class="fields">
		{!! csrf_field() !!}
		<div class="form-group">
			<textarea maxlength="160" tabindex="1" class="form-control" name="content" placeholder="What's on your mind, {{member()->firstname}}?"></textarea>
		</div>
		<div class="form-group">
			<div class="pull-left char-parent">
				<div class="char">160</div>
			</div>
			<div class="pull-right">
				<label id="pick-gif-group">
					<input class="hidden" type="file" name="attachment">
					<a class="btn btn-danger" tabindex="2"><i class="ion ion-image"></i> Pick GIF</a>
				</label>
				<button tabindex="3" type="submit" class="btn submit btn-primary">Post</button>
			</div>
		</div>
	</div>
	<div class="loader"></div>		
</form>
