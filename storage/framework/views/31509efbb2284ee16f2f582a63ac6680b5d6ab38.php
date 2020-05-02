<div class="panel transparent">
	<div class="panel-body">
		<div class="footer">
			<ul class="footer-nav">
				<li><a href="<?php echo e(route('pages.view', 'about')); ?>">About</a></li>
				<li><a href="<?php echo e(route('pages.view', 'contact')); ?>">Contact</a></li>
				<li><a href="<?php echo e(route('help')); ?>">Help</a></li>
			</ul>
			<div class="copyright">	
				Copyright &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All Right Reserved
			</div>
		</div>
	</div>
</div>
