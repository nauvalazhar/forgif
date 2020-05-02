<?php $__env->startSection('title', 'Help Center'); ?>
<?php $__env->startSection('og'); ?>
<meta property="og:url" content="<?php echo e(url('')); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Help Center &mdash; <?php echo e(config('app.name')); ?>" />
<meta property="og:description" content="Welcome to the help center, on this page you can 
learn everything about Forgif" />
<meta property="og:image" content="<?php echo e(url('media/forgif-cover.png')); ?>" />
<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>" />

<meta itemprop="name" content="Help Center &mdash; <?php echo e(config('app.name')); ?>">
<meta itemprop="description" content="Welcome to the help center, on this page you can 
learn everything about Forgif">
<meta itemprop="image" content="<?php echo e(url('media/forgif-cover.png')); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Help Center &mdash; <?php echo e(config('app.name')); ?>">
<meta name="twitter:description" content="Welcome to the help center, on this page you can 
learn everything about Forgif">
<meta name="twitter:image:src" content="<?php echo e(url('media/forgif-cover.png')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="page primary margin-bottom help" style="background-image: url('<?php echo e(url('media/help.jpeg')); ?>');">
	<div class="overlay"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center page-title">
				<h2>Help Center</h2>
				<p class="lead">Welcome to the help center, on this page you can <br>learn everything about Forgif</p>
				<div class="form-search">
					<form method="get" action="<?php echo e(route('help')); ?>">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="What can we help?">							
								<div class="input-group-btn">
									<button class="btn btn-default"><i class="ion-search"></i></button>
								</div>
							</div>
							<?php if(@$q): ?>
							<div class="text-left help-text white">
								Search: <?php echo e($q); ?>

							</div>
							<?php endif; ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page">
	<div class="container-fluid">
		<div class="row">
			<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-md-3 col-xs-6 col-sm-4">
				<div class="panel padding equal sm round center">
					<div class="panel-heading">
						<h4><?php echo e($page->title); ?></h4>
					</div>
					<div class="panel-cta fixed">
						<a href="<?php echo e(route('pages.view', $page->slug)); ?>?ref=help">Learn More</a>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<?php echo $pages->links(); ?>

			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>