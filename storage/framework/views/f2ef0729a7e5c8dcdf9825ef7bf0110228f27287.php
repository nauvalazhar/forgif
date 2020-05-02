<?php $__env->startComponent('mail::message'); ?>
# Thank you for signing up

Hello <?php echo e($user['name']); ?>,
Welcome to <?php echo e(config('app.name')); ?>, you need to activate your account to share your GIF.<br>

<?php $__env->startComponent('mail::button', ['url' => route('users.activate', Crypt::encrypt($user['id']))]); ?>
Activate Account
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
