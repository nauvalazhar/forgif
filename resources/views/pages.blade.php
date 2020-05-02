@extends('layouts.app')
@section('title', 'Pages')
@section('css')
<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{url('scripts/froala/css/froala_style.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('scripts/froala/css/froala_editor.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('scripts/froala/css/froala_editor.pkgd.min.css')}}">
@stop

@section('content')
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="panel padding">
					<div class="panel-heading">
						<h4>Pages</h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-hover table-striped">
							@foreach($pages as $page)
							<tr>
								<td>{{$page->title}}
								<br>
								<a href="{{route('pages.view', $page->slug)}}">View</a> &bull; 
								<a href="{{route('pages.edit', Crypt::encrypt($page->id))}}">Edit</a> &bull; 
								<a href="{{route('pages.delete', Crypt::encrypt($page->id))}}">Delete</a>
								</td>
							</tr>
							@endforeach
						</table>
						{!! $pages->links() !!}
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="panel padding">
					<div class="panel-heading">
						@if(@$id)
						<h4>Update Page</h4>
						@elseif(@$page_delete)
						<h4>Delete Page <i>"{{$page_delete->title}}"</i></h4>
						@else
						<h4>Create New Page</h4>
						@endif
					</div>
					<div class="panel-body">
						@if(@session('msg'))
							<div class="alert alert-success">
								{!! session('msg') !!}
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
						@if(@$page_delete)
						<form action="{{route('pages.destroy', Crypt::encrypt($page_delete->id))}}" method="post">
							{!! csrf_field() !!}
							{!! method_field('delete') !!}
							<p>This action can't be undone, do you want to continue?</p>
							<button type="submit" class="btn btn-danger">Delete</button>
							<a href="{{route('pages')}}" class="btn btn-default">Cancel</a>
						</form>
						@else
						@if(@$id)
						<form method="post" action="{{route('pages.update', Crypt::encrypt($id))}}">
						{!! method_field('patch') !!}
						@else
						<form method="post" action="{{route('pages.create')}}">
						@endif
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" class="form-control" value="{{isset($id) ? $page_edit->title : ''}}">
							</div>
							<div class="form-group">
								<label>Slug</label>
								<input type="text" name="slug" class="form-control" value="{{isset($id) ? $page_edit->slug : ''}}">
							</div>
							<div class="form-group">
								<label>Keywords</label>
								<input type="text" name="keywords" class="form-control" value="{{isset($id) ? $page_edit->keywords : ''}}">
							</div>
							<div class="form-group">
								<label>Content</label>
								<textarea style="height: 240px;" class="form-control" name="content">{{isset($id) ? $page_edit->content : ''}}</textarea>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status">
									<option value="publish"{{isset($id) && $page_edit->status == 'publish' ? ' selected' : ''}}>Publish</option>
									<option value="draft"{{isset($id) && $page_edit->status == 'draft' ? ' selected' : ''}}>Draft</option>
								</select>
							</div>
							<div class="form-group">
								@if(@$id)
								<button class="btn btn-primary">Save Changes</button>
								@else
								<button class="btn btn-primary">Create One</button>
								@endif
								@if(@$id)
								<a href="{{route('pages')}}" class="btn btn-default">Cancel</a>
								@endif
							</div>
						</form>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop

@section('js')
<script src="{{url('scripts/froala/js/froala_editor.min.js')}}"></script>
<script src="{{url('scripts/froala/js/froala_editor.pkgd.min.js')}}"></script>
<script> $(function() { $('textarea').froalaEditor({
      dragInline: false,
      toolbarButtons: ['bold', 'italic', 'underline', 'insertImage', 'insertLink', 'undo', 'redo', 'emoticons','table', 'video','code', 'fullscreen'],
      pluginsEnabled: ['image', 'link', 'draggable','emoticons','table', 'video','code', 'fullscreen']
    }) }); </script>
@stop