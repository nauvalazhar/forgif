<?php $__env->startSection('title', 'Page not Found'); ?>

<?php $__env->startSection('content'); ?>
<section>
  <div class="container-fluid">
    <div class="row">
	    <div class="col-md-8 col-md-offset-2 notfound">
		    <div class="icon">	    	
			    <i class="ion-speedometer"></i>
		    </div>
		    <h1>Page Not Found</h1>
		    <p class="lead">
		    	The page you were looking for could not be found
		    </p>
		    <div class="cta">
		    	<a href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-lg">Back to Home</a>
		    </div>
	    </div>
	  </div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>