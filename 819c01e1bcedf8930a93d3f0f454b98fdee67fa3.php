

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card sticky-top" style="top:30px">
                            <div class="list-group list-group-flush" id="useradd-sidenav">
                                <?php echo $__env->make('landingpage::layouts.tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                    
                        <?php echo e(Form::model(null, array('route' => array('landingpage.store'), 'method' => 'POST'))); ?>

                            <?php echo csrf_field(); ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h5 class="mb-2"><?php echo e(__('Top Bar')); ?></h5>
                                        </div>
                                        <div class="col switch-width text-end">
                                            <div class="form-group mb-0">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="" name="topbar_status"
                                                        id="topbar_status"  <?php echo e($settings['topbar_status'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label" for="topbar_status"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <?php echo e(Form::label('content', __('Message'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::textarea('topbar_notification_msg',$settings['topbar_notification_msg'], ['class' => 'ckdescription form-control', 'required' => 'required', 'id'=>''])); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    
                    </div>
                </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="<?php echo e(asset('Modules/LandingPage/Resources/assets/js/editorplaceholder.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $.each($('.ckdescription'), function(i, editor) {
                CKEDITOR.replace(editor, {
                    // contentsLangDirection: 'rtl',
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
      
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\QuantmHill\erp_system\Modules/LandingPage\Resources/views/landingpage/topbar.blade.php ENDPATH**/ ?>