<?php $__env->startSection('title', 'Register'); ?>

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
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="name" class="control-label">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                    <?php if($errors->has('name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="control-label">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label for="password" class="control-label">Password</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="control-label">Confirm Password</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group text-right">
                    <div class="pull-left text-left" style="width: 170px;">
                        <small>By register you agree with our terms and conditions</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Register
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