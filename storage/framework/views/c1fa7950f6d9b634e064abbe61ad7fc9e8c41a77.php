<?php $__env->startSection('title', $user->name); ?>

<?php $__env->startSection('content'); ?>
<section class="cover" style="background-image: url(<?php echo e(cover($user->cover)); ?>);">
	<div class="overlay"></div>
	<div class="container-fluid">
		<div class="user">
			<figure>
				<?php if($user->id == @Auth::user()->id): ?>
				<a href="<?php echo e(route('users.picture')); ?>">
					<div>
						<img src="<?php echo avatar($user->picture,'_lg'); ?>">
					</div>
				</a>
				<?php else: ?>
					<img src="<?php echo avatar($user->picture,'_lg'); ?>">
				<?php endif; ?>
			</figure>
			<div class="desc">
				<div class="name"><?php echo e($user->name); ?> <?php echo $user->verified == 1 ? '<div class="verified" title="Verified"></div>' : ''; ?></div>
				<div class="info"><?php echo e("@".$user->username); ?></div>
				<?php if(Auth::check() && $user->id !== @Auth::user()->id): ?>
					<div class="cta-forgif">
					<?php echo forgifButton($user, ''); ?>

					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if($user->id == @Auth::user()->id): ?>
		<div class="cta">
			<a href="<?php echo e(route('users.cover')); ?>" class="btn btn-primary"><i class="ion ion-edit"></i> Change Cover</a>
		</div>
		<?php endif; ?>
	</div>
</section>

<section>
  <div class="container-fluid">
    <div class="row">
	    <div class="col-md-8 col-md-offset-2">
		    <div class="user-info-group">	    	
			    <div class="user-info">
			    	<div class="user-info-item">
			    		<div>
			    			<div class="name"><a href="<?php echo e(route('users.detail', $user->username)); ?>">Posts</a></div>
			    			<div class="value"><?php echo e($user->posts); ?></div>
			    		</div>
			    	</div>
			    	<div class="user-info-item">
			    		<div>
			    			<div class="name"><a href="<?php echo e(route('users.forgifings', $user->username)); ?>">Forgifings</a></div>
			    			<div class="value"><?php echo e($user->forgifing); ?></div>
			    		</div>
			    	</div>
			    	<div class="user-info-item">
			    		<div>
			    			<div class="name"><a href="<?php echo e(route('users.forgifers', $user->username)); ?>">Forgifers</a></div>
			    			<div class="value"><?php echo e($user->forgifers); ?></div>
			    		</div>
			    	</div>
			    </div>
			    <div class="user-info-bio">
				    <?php if($user->location): ?>
					    From <?php echo $user->location; ?> - 
				    <?php endif; ?>
			    	<?php echo bio($user->bio, $user); ?>

			    </div>
		    </div>
	    </div>
		</div>
	  <?php if(isset($forgifings)): ?>
	  	<div class="row">
	  		<div class="col-md-8 col-md-offset-2 col-sm-12">
	  			<div class="panel padding">
		  			<div class="panel-heading">
		  				<h4>Forgifings</h4>
		  			</div>
		  			<div class="panel-body">
			  			<?php if(!count($forgifings)): ?>
				  			<p class="text-center"><i><?php echo e(firstname($user->name)); ?> never forgifing anyone.</i></p>
			  			<?php else: ?>
								<ul class="user-list">
									<?php $__currentLoopData = $forgifings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="friend-list-<?php echo e($user->users_from->id); ?>">
										<figure>
											<a href="<?php echo e(route('users.detail', $user->users_from->username)); ?>">
												<img src="<?php echo avatar($user->users_from->picture, '_md'); ?>" alt="<?php echo e($user->users_from->name); ?>">
											</a>
										</figure>
										<div class="desc">
											<div class="name"><a href="<?php echo e(route('users.detail', $user->users_from->username)); ?>"><?php echo e($user->users_from->name); ?></a></div>
											<div class="action">
												<?php echo e('@'.$user->users_from->username); ?>

											</div>
										</div>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<div class="text-center">
									<?php echo $forgifings->links(); ?>

								</div>
			  			<?php endif; ?>
		  			</div>
	  			</div>
	  		</div>
	  	</div>
	  <?php elseif(isset($forgifers)): ?>
	  	<div class="row">
	  		<div class="col-md-8 col-md-offset-2 col-sm-12">
	  			<div class="panel padding">
		  			<div class="panel-heading">
		  				<h4>Forgifers</h4>
		  			</div>
		  			<div class="panel-body">
			  			<?php if(!count($forgifers)): ?>
				  			<p class="text-center"><i><?php echo e(firstname($user->name)); ?> has no one forgifers.</i></p>
			  			<?php else: ?>
								<ul class="user-list">
									<?php $__currentLoopData = $forgifers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="friend-list-<?php echo e($user->users->id); ?>">
										<figure>
											<a href="<?php echo e(route('users.detail', $user->users->username)); ?>">
												<img src="<?php echo avatar($user->users->picture, '_md'); ?>" alt="<?php echo e($user->users->name); ?>">
											</a>
										</figure>
										<div class="desc">
											<div class="name"><a href="<?php echo e(route('users.detail', $user->users->username)); ?>"><?php echo e($user->users->name); ?></a></div>
											<div class="action">
												<?php echo e('@'.$user->users->username); ?>

											</div>
										</div>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<div class="text-center">
									<?php echo $forgifers->links(); ?>

								</div>
			  			<?php endif; ?>
		  			</div>
	  			</div>
	  		</div>
	  	</div>
	  <?php else: ?>
	    <div class="row">
		    <div class="col-md-8 col-md-offset-2 col-sm-12">
	        <?php $__env->startComponent('parts.element_status'); ?>
	        <?php $__env->slot('me', true); ?>
	        <?php echo $__env->renderComponent(); ?>
		    </div>
	    </div>
	  <?php endif; ?>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
getStatus($("[data-status-loader-me]"), '<?php echo e($user->id); ?>');
$(window).scroll(function(){
  if($(window).scrollTop() >= ($(document).height() - $(window).height()) - 100){
    getStatus($("[data-status-loader-me]"), '<?php echo e($user->id); ?>');
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>