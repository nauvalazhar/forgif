@extends('layouts.app')
@section('title', 'Change Profile Cover')

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
				<form action="{{route('users.cover_update')}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				{!! method_field('PATCH') !!}
					<div class="panel padding">
						<div class="panel-heading">
							<h4>Profile Cover</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="required">Select Cover</label>
								<input type="file" name="cover" class="form-control" id="cover">
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
