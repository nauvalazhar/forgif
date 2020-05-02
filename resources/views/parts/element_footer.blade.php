<div class="panel transparent">
	<div class="panel-body">
		<div class="footer">
			<ul class="footer-nav">
				<li><a href="{{route('pages.view', 'about')}}">About</a></li>
				<li><a href="{{route('pages.view', 'contact')}}">Contact</a></li>
				<li><a href="{{route('help')}}">Help</a></li>
			</ul>
			<div class="copyright">	
				Copyright &copy; {{date('Y')}} {{config('app.name')}}. All Right Reserved
			</div>
		</div>
	</div>
</div>
