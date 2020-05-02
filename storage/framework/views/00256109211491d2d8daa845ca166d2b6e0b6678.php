<?php $__env->startSection('title', 'Reset Password'); ?>

<?php $__env->startSection('content'); ?>
<section class="fs-sec">
    <div class="bg" style="background-image: url(<?php echo e(url('media/bg.jpg')); ?>);">
        <div class="overlay"></div>
        <div class="caption">
            <h1>Welcome to <?php echo e(config('app.name')); ?></h1>
            <p class="lead">Let's waste your time on some unimportant GIFs here</p>
            <div class="cta">
                <a href="<?php echo e(route('help')); ?>" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">        
            <div class="brand">
                <a href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(url(config('app.logo'))); ?>" alt="Forgif Logo">
                </a>
            </div>
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="control-label">E-Mail Address</label>

                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        Send Link
                    </button>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            Already have an account? <a href="<?php echo e(route('login')); ?>">Login</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['navbar' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>