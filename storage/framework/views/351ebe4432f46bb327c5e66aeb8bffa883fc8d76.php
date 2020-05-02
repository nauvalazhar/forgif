<?php $__env->startSection('title', 'Contact'); ?>

<?php $__env->startSection('content'); ?>
<section class="settings-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				<div class="panel padding">
					<div class="panel-heading">
						<h4>Contact</h4>
					</div>
					<div class="panel-body">
						Hi! Thanks for using Forgif, if you have some questions or you have found a bug you, can contact us.
						<br>
						<br>
						Email: <a href="mailto:hi@forgif.us">hi@forgif.us</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>