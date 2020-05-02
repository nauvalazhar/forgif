<?php $__env->startSection('title', 'Change Profile Cover'); ?>

<?php $__env->startSection('content'); ?>
<section class="settings-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			<?php if(session('success')): ?>
				<div class="alert alert-success">
					<?php echo e(session('success')); ?>

				</div>
			<?php endif; ?>

				<?php if($errors->any()): ?>
				    <div class="alert alert-danger">
				        <ul>
				            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                <li><?php echo e($error); ?></li>
				            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				        </ul>
				    </div>
				<?php endif; ?>
				<form action="<?php echo e(route('users.cover_update')); ?>" method="post" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<?php echo method_field('PATCH'); ?>

					<div class="panel padding">
						<div class="panel-heading">
							<h4>Profile Cover</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="required">Select Cover</label>
								<input type="file" name="cover" class="form-control" id="cover">
							</div>
						</div>
						<div class="panel-footer text-right">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<button type="reset" class="btn btn-danger">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>