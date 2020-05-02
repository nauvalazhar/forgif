@extends('layouts.app')
@section('title', 'Reports')

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
				<div class="panel padding">
					<div class="panel-heading">
						<h4>Reports</h4>
					</div>
					<div class="panel-body">
						@if(count($reports))
	          <ul class="user-list">
	              @foreach($reports as $report)
	              <li>
	                  <figure>
	                      <a href="{{route("users.detail", $report->users->username)}}">
	                          <img src="{!! avatar($report->users->picture.'_md') !!}" alt="{{$report->users->name}}">
	                      </a>
	                  </figure>
	                  <div class="desc">
	                      <div class="name">Reported by <a href="{{ route('users.detail', $report->users->username) }}">{{$report->users->name}}</a></div>
	                      <div class="action">
	                      	<strong>Reason:</strong> <br>{{$report->reason}}
	                      	<br>
	                      	<br>
	                      	<strong>Created at:</strong> {{$report->created_at}}
	                      </div>
	                      <br>
	                      <form id="rpt-{{$report->id}}" onsubmit="return confirm('Are you sure?');" method="post" action="{{ route('report.destroy') }}">
	                      	{!! csrf_field() !!}
	                      	{!! method_field('delete') !!}
	                      	<input type="hidden" name="id" value="{{$report->id}}">
	                      </form>
	                      <a role="button" onclick="$('#rpt-{{$report->id}}').submit();" class="btn btn-sm btn-danger"><i class="ion-close"></i> Delete Post</a>
	                      <a href="{{ route('status.view', myenc($report->post_id)) }}" class="btn btn-sm btn-default">View Post</a>
	                  </div>
	              </li>
	              @endforeach
	          </ul>
	          @else
	          <p class="lead text-center"><i>No reports</i></p>
	          @endif
					</div>
					<div class="panel-footer text-center">
						{!! $reports->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
