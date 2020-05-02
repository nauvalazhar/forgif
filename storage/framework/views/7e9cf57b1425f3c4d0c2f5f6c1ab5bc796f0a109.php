<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('og'); ?>
<meta property="og:url" content="<?php echo e(url('login')); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Let's waste your time in <?php echo e(config('app.name')); ?>" />
<meta property="og:description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing." />
<meta property="og:image" content="<?php echo e(url('media/forgif-cover.png')); ?>" />
<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>" />

<meta itemprop="name" content="Let's waste your time in <?php echo e(config('app.name')); ?>">
<meta itemprop="description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing.">
<meta itemprop="image" content="<?php echo e(url('media/forgif-cover.png')); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Let's waste your time in <?php echo e(config('app.name')); ?>">
<meta name="twitter:description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing.">
<meta name="twitter:image:src" content="<?php echo e(url('media/forgif-cover.png')); ?>">
<?php $__env->stopSection(); ?>

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
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="control-label">Email</label>

                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label for="password" class="control-label fw">Password
                    <div class="pull-right">
                        <a href="<?php echo e(route('password.request')); ?>" tabindex="-1">Forgot password?</a>
                    </div>
                    </label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group text-right">
                    <label class="pull-left remember-me">
                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                    </label>

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </form>

            <div class="sm-title ocl">or one click login</div>
            <a href="<?php echo e(url('login/facebook')); ?>" class="btn btn-facebook btn-block"><i class="ion ion-social-facebook"></i> Login with Facebook</a>
        </div>
        <div class="panel-footer">
            Don't have an account? <a href="<?php echo e(route('register')); ?>">Create one</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['navbar' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>