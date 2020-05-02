<?php $__env->startSection('title', $page->title); ?>
<?php $__env->startSection('og'); ?>
<meta property="og:url" content="<?php echo e(route('pages.view', $page->slug)); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo e($page->title); ?>" />
<meta property="og:description" content="<?php echo e(strip_tags($page->content)); ?>." />
<meta property="og:image" content="<?php echo e(url('media/forgif-cover.png')); ?>" />
<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>" />

<meta itemprop="name" content="<?php echo e($page->title); ?>">
<meta itemprop="description" content="<?php echo e(strip_tags($page->content)); ?>.">
<meta itemprop="image" content="<?php echo e(url('media/forgif-cover.png')); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($page->title); ?>">
<meta name="twitter:description" content="<?php echo e(strip_tags($page->content)); ?>.">
<meta name="twitter:image:src" content="<?php echo e(url('media/forgif-cover.png')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="page">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-10 col-md-offset-1">
				<div class="panel padding">
					<?php if(isset(request()->ref) == 'help'): ?>
						<div class="panel-heading">
							<a href="<?php echo e(route('help')); ?>" class="link-icon"><i class="ion ion-ios-arrow-left"></i> Back to Help Center</a>
						</div>
					<?php endif; ?>
					<div class="panel-heading">
						<h4><?php echo e($page->title); ?></h4>
					</div>
					<div class="panel-body">
						<ul class="meta">
							<li><?php echo $page->created_at->diffForHumans(); ?></li>
							<?php if(isset($page->updated_at)): ?>
							<li>Updated at: <?php echo $page->updated_at; ?></li>
							<?php endif; ?>
							<li><?php echo $page->users->name; ?></li>
						</ul>
						<?php echo $page->content; ?>

					</div>
					<div class="panel-footer grey">
						<h4>You may also read</h4>
						<ul class="square">
							<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><a href="<?php echo e(route("pages.view", $item->slug)); ?>"><?php echo e($item->title); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>