@extends('layouts.app')
@section('title', 'Account Settings')

@section('content')
<section class="settings-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			@if(session('success'))
				<div class="alert alert-success">
					{{session('success')}}
				</div>
			@endif

				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<form action="{{route('users.update')}}" method="post">
				{!! csrf_field() !!}
				{!! method_field('PATCH') !!}
					<div class="panel padding">
						<div class="panel-heading">
							<h4>Settings</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="required">Name</label>
								<input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
							</div>
							<div class="form-group">
								<label class="required">Email</label>
								<input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
								<div class="help-text">All update information will be sent to your email</div>
							</div>
							<div class="form-group">
								<label class="required">Username</label>
								<input type="text" name="username" class="form-control" value="{{Auth::user()->username}}">
								<div class="help-text">Username will be used for URL to your profile page</div>
							</div>
							<div class="form-group">
								<label>Location</label>
								<input type="text" name="location" class="form-control" {{Auth::user()->location}}>
								<div class="help-text">Usually filled with a city or country name</div>
							</div>
							<div class="form-group">
								<label>Bio</label>
								<textarea name="bio" class="form-control">{{Auth::user()->bio}}</textarea>
								<div class="help-text">Give a little information about yourself</div>
							</div>
							<div class="form-group">
								<label><input type="checkbox" class="password-sec-toggle"> Change password too</label>
							</div>
							<div class="password-sec" style="display: none;">							
								<div class="form-group">
									<label class="required">Password</label>
									<input type="password" name="password" class="form-control">
								</div>
								<div class="form-group">
									<label class="required">Password Confirm</label>
									<input type="password" name="password_confirmation" class="form-control">
								</div>
							</div>
						</div>
						<div class="panel-footer text-right">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<button type="reset" class="btn btn-danger">Reset</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</section>
@stop

@section('js')
<script>
	$(function(){
		$(".password-sec-toggle").change(function(){
			if($(this).is(":checked")) {
				$(".password-sec").slideDown();
			}else{
				$(".password-sec").slideUp();
			}
		});
	});
</script>
@stop