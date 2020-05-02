<?php if(isset($me) && $me == true): ?>
<div data-status-loader-me></div>

<div class="text-center">
	<div class="infinite-scroll-loader">
		<img src="<?php echo url('media/loader.gif'); ?>">
	</div>
	<div class="infi-end">
		<h1>
			<i class="ion-images"></i>
		</h1>
		No more posts
	</div>
</div>
<?php else: ?>
<div data-status-loader></div>

<div class="text-center">
	<div class="infinite-scroll-loader">
		<img src="<?php echo url('media/loader.gif'); ?>">
	</div>
	<div class="infi-end">
		<h1>
			<i class="ion-ios-people"></i>
		</h1>
		Add more friends and get more GIFs
		<div class="cta">		
			<a href="<?php echo e(route('users.friends')); ?>" class="btn btn-primary">Find Friends</a>
		</div>
	</div>
</div>

<?php endif; ?>