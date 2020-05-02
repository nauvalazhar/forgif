@extends('layouts.app')
@section('title', 'Change Profile Picture')

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
				<form action="{{route('users.picture_update')}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				{!! method_field('PATCH') !!}
					<div class="panel padding">
						<div class="panel-heading">
							<h4>Profile Picture</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="required">Select Picture</label>
								<input type="file" name="picture" class="form-control" id="picture">
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
