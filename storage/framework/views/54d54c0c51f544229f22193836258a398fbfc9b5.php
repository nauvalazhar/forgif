<?php if(count(Friends::mayKnow()) > 0): ?>
<ul class="user-list">
	<?php $__currentLoopData = Friends::mayKnow(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li class="friend-list-<?php echo e($user->id); ?>">
		<figure>
			<a href="<?php echo e(route('users.detail', $user->username)); ?>">
				<img src="<?php echo avatar($user->picture, '_md'); ?>" alt="<?php echo e($user->name); ?>">
			</a>
		</figure>
		<div class="desc">
			<div class="name"><a href="<?php echo e(route('users.detail', $user->username)); ?>"><?php echo e($user->name); ?></a></div>
			<div class="action">
				<?php echo forgifButton($user); ?>

			</div>
		</div>
	</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php else: ?>
<div class="text-center">	
	<i>
		Whooppss! Sorry, no friends found.
	</i>
</div>
<?php endif; ?>