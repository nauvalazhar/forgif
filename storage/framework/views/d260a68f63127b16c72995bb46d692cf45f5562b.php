<?php $__env->startSection('title', 'Let\'s waste your time'); ?>
<?php $__env->startSection('og'); ?>
<meta property="og:url" content="<?php echo e(url('')); ?>" />
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
<section class="home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div id="primary-sidebar">
                    <div class="panel panel-default">
                        <div class="panel-heading">You may also know
                        <div class="pull-right">
                            <a href="<?php echo e(route('users.friends')); ?>">See All</a>
                        </div>
                        </div>
                        <div class="panel-body">
                            <?php $__env->startComponent('parts.element_friends'); ?>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                    <?php $__env->startComponent('parts.element_footer'); ?>
                    <?php echo $__env->renderComponent(); ?>
                </div>
            </div>
            <div class="col-md-7">
                <?php $__env->startComponent('parts.form_status'); ?>
                <?php echo $__env->renderComponent(); ?>                    
                <h2 class="sm-title">Let's waste your time</h2>
                <?php $__env->startComponent('parts.element_status'); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
getStatus($("[data-status-loader]"));
$(window).scroll(function(){
  if($(window).scrollTop() >= ($(document).height() - $(window).height()) - 100){
    getStatus($("[data-status-loader]"));
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['footer' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>