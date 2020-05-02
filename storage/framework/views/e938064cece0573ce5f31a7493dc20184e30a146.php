<form action="<?php echo e(route('status.post')); ?>" method="post" enctype="multipart/form-data" id="form-status">
	<?php if(!Auth::check()): ?>
		<div class="overlay--auth">
			<div class="icon">			
				<i class="ion-log-in"></i>
			</div>
			You need to <a href="<?php echo e(route('login')); ?>">login</a> or <a href="<?php echo e(route('register')); ?>">register</a><br>to share your GIF
		</div>
	<?php endif; ?>
	<figure>
		<img src="<?php echo e(avatar(@Auth::user()->picture)); ?>">
	</figure>
	<div class="fields">
		<?php echo csrf_field(); ?>

		<div class="form-group">
			<textarea maxlength="160" tabindex="1" class="form-control" name="content" placeholder="What's on your mind, <?php echo e(member()->firstname); ?>?"></textarea>
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
