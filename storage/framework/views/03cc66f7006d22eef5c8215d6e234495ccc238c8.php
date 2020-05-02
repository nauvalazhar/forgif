<?php $__env->startSection('title', 'Pages'); ?>
<?php $__env->startSection('css'); ?>
<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(url('scripts/froala/css/froala_style.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(url('scripts/froala/css/froala_editor.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(url('scripts/froala/css/froala_editor.pkgd.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="panel padding">
					<div class="panel-heading">
						<h4>Pages</h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-hover table-striped">
							<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($page->title); ?>

								<br>
								<a href="<?php echo e(route('pages.view', $page->slug)); ?>">View</a> &bull; 
								<a href="<?php echo e(route('pages.edit', Crypt::encrypt($page->id))); ?>">Edit</a> &bull; 
								<a href="<?php echo e(route('pages.delete', Crypt::encrypt($page->id))); ?>">Delete</a>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</table>
						<?php echo $pages->links(); ?>

					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="panel padding">
					<div class="panel-heading">
						<?php if(@$id): ?>
						<h4>Update Page</h4>
						<?php elseif(@$page_delete): ?>
						<h4>Delete Page <i>"<?php echo e($page_delete->title); ?>"</i></h4>
						<?php else: ?>
						<h4>Create New Page</h4>
						<?php endif; ?>
					</div>
					<div class="panel-body">
						<?php if(@session('msg')): ?>
							<div class="alert alert-success">
								<?php echo session('msg'); ?>

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
						<?php if(@$page_delete): ?>
						<form action="<?php echo e(route('pages.destroy', Crypt::encrypt($page_delete->id))); ?>" method="post">
							<?php echo csrf_field(); ?>

							<?php echo method_field('delete'); ?>

							<p>This action can't be undone, do you want to continue?</p>
							<button type="submit" class="btn btn-danger">Delete</button>
							<a href="<?php echo e(route('pages')); ?>" class="btn btn-default">Cancel</a>
						</form>
						<?php else: ?>
						<?php if(@$id): ?>
						<form method="post" action="<?php echo e(route('pages.update', Crypt::encrypt($id))); ?>">
						<?php echo method_field('patch'); ?>

						<?php else: ?>
						<form method="post" action="<?php echo e(route('pages.create')); ?>">
						<?php endif; ?>
							<?php echo csrf_field(); ?>

							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" class="form-control" value="<?php echo e(isset($id) ? $page_edit->title : ''); ?>">
							</div>
							<div class="form-group">
								<label>Slug</label>
								<input type="text" name="slug" class="form-control" value="<?php echo e(isset($id) ? $page_edit->slug : ''); ?>">
							</div>
							<div class="form-group">
								<label>Keywords</label>
								<input type="text" name="keywords" class="form-control" value="<?php echo e(isset($id) ? $page_edit->keywords : ''); ?>">
							</div>
							<div class="form-group">
								<label>Content</label>
								<textarea style="height: 240px;" class="form-control" name="content"><?php echo e(isset($id) ? $page_edit->content : ''); ?></textarea>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status">
									<option value="publish"<?php echo e(isset($id) && $page_edit->status == 'publish' ? ' selected' : ''); ?>>Publish</option>
									<option value="draft"<?php echo e(isset($id) && $page_edit->status == 'draft' ? ' selected' : ''); ?>>Draft</option>
								</select>
							</div>
							<div class="form-group">
								<?php if(@$id): ?>
								<button class="btn btn-primary">Save Changes</button>
								<?php else: ?>
								<button class="btn btn-primary">Create One</button>
								<?php endif; ?>
								<?php if(@$id): ?>
								<a href="<?php echo e(route('pages')); ?>" class="btn btn-default">Cancel</a>
								<?php endif; ?>
							</div>
						</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(url('scripts/froala/js/froala_editor.min.js')); ?>"></script>
<script src="<?php echo e(url('scripts/froala/js/froala_editor.pkgd.min.js')); ?>"></script>
<script> $(function() { $('textarea').froalaEditor({
      dragInline: false,
      toolbarButtons: ['bold', 'italic', 'underline', 'insertImage', 'insertLink', 'undo', 'redo', 'emoticons','table', 'video','code', 'fullscreen'],
      pluginsEnabled: ['image', 'link', 'draggable','emoticons','table', 'video','code', 'fullscreen']
    }) }); </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>