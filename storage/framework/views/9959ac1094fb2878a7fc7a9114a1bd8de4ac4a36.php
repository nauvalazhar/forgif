<?php $__env->startSection('title', 'GIF by ' . $status->users->name); ?>
<?php $__env->startSection('og'); ?>
<meta property="og:url" content="<?php echo e(route('status.view', myenc($status->id))); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="See GIF from <?php echo e($status->users->name); ?>" />
<meta property="og:description" content="<?php echo $status->content; ?>" />
<meta property="og:image" content="<?php echo e(url('media/thumbs/' . $status->attachment . '.png')); ?>" />
<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>" />

<meta itemprop="name" content="See GIF from <?php echo e($status->users->name); ?>">
<meta itemprop="description" content="<?php echo $status->content; ?>">
<meta itemprop="image" content="<?php echo e(url('media/thumbs/' . $status->attachment . '.png')); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="See GIF from <?php echo e($status->users->name); ?>">
<meta name="twitter:description" content="<?php echo $status->content; ?>">
<meta name="twitter:image:src" content="<?php echo e(url('media/thumbs/' . $status->attachment . '.png')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="settings-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			<div class="card-post" id="gif--id--<?php echo e($status->id); ?>">
				<div class="card-post-detail">
					<div class="user">
						<figure>
							<a href="<?php echo e(route('users.detail',$status->users->username)); ?>">
								<img src="<?php echo e(avatar($status->users->picture)); ?>">
							</a>
						</figure>
						<div class="user-info">
							<div class="name"><a href="<?php echo e(route('users.detail', $status->users->username)); ?>"><?php echo e($status->users->name); ?></a></div>
							<div class="time"><?php echo e($status->date); ?></div>
						</div>
					</div>

          <?php if(Auth::check()): ?>
					<div class="buttons">
						<!--<a role="button"><i class="ion-chatbubble"></i> <span>100</span></a>-->
						<a role="button" class="option post--like<?php echo e(($status->has_like ? ' active': '')); ?>" data-id="<?php echo e($status->id); ?>"<?php echo e(($status->has_like ? ' data-unlike="true"':'')); ?>><i class="ion-heart"></i> <span><?php echo e($status->like_count); ?></span></a>
						<div class="options dropdown">
							<a href="#" data-toggle="dropdown"><i class="ion-android-more-vertical"></i></a>
							<ul class="dropdown-menu">	
							<?php if($status->owner): ?>
								<li><a role="button" class="post--edit" data-id="<?php echo e($status->id); ?>">Edit</a></li>
							<?php endif; ?>
							<?php if($status->owner || $status->admin): ?>
								<li><a role="button" class="post--delete" data-id="<?php echo e($status->id); ?>">Delete</a></li>
							<?php endif; ?>
							<li><a role="button" class="post--getlink" data-link="<?php echo e($status->link); ?>">Get Link</a></li>

							<?php if(!$status->owner): ?>			
								<li><a role="button" class="post--report" data-id="<?php echo e($status->id); ?>">Report</a></li>
							<?php endif; ?>
							</ul>
						</div>
					</div>
					<?php endif; ?>
					<div class="caption">
						<?php echo $status->content; ?>

					</div>
				</div>
				<?php if($status->privacy == 'public'): ?>
					<div class="post-badge" title="Public Post">
						<i class="ion-fireball"></i> Public
					</div>
				<?php endif; ?>
				<?php echo gif($status->attachment); ?>

				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>