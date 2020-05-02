<?php $__env->startSection('title', 'Reports'); ?>

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
				<div class="panel padding">
					<div class="panel-heading">
						<h4>Reports</h4>
					</div>
					<div class="panel-body">
						<?php if(count($reports)): ?>
	          <ul class="user-list">
	              <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	              <li>
	                  <figure>
	                      <a href="<?php echo e(route("users.detail", $report->users->username)); ?>">
	                          <img src="<?php echo avatar($report->users->picture.'_md'); ?>" alt="<?php echo e($report->users->name); ?>">
	                      </a>
	                  </figure>
	                  <div class="desc">
	                      <div class="name">Reported by <a href="<?php echo e(route('users.detail', $report->users->username)); ?>"><?php echo e($report->users->name); ?></a></div>
	                      <div class="action">
	                      	<strong>Reason:</strong> <br><?php echo e($report->reason); ?>

	                      	<br>
	                      	<br>
	                      	<strong>Created at:</strong> <?php echo e($report->created_at); ?>

	                      </div>
	                      <br>
	                      <form id="rpt-<?php echo e($report->id); ?>" onsubmit="return confirm('Are you sure?');" method="post" action="<?php echo e(route('report.destroy')); ?>">
	                      	<?php echo csrf_field(); ?>

	                      	<?php echo method_field('delete'); ?>

	                      	<input type="hidden" name="id" value="<?php echo e($report->id); ?>">
	                      </form>
	                      <a role="button" onclick="$('#rpt-<?php echo e($report->id); ?>').submit();" class="btn btn-sm btn-danger"><i class="ion-close"></i> Delete Post</a>
	                      <a href="<?php echo e(route('status.view', myenc($report->post_id))); ?>" class="btn btn-sm btn-default">View Post</a>
	                  </div>
	              </li>
	              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	          </ul>
	          <?php else: ?>
	          <p class="lead text-center"><i>No reports</i></p>
	          <?php endif; ?>
					</div>
					<div class="panel-footer text-center">
						<?php echo $reports->links(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>