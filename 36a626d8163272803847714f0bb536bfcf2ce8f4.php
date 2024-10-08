
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Users')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Users')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user logs history')): ?>
            <a href="<?php echo e(route('users.userlog.history')); ?>" class="btn btn-sm btn-primary"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('User Logs History')); ?>"><i class="ti ti-user-check"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user import')): ?>
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Import')); ?>"
                data-url="<?php echo e(route('users.file.import')); ?>" data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i
                    class="ti ti-file-import"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user manage')): ?>
            <a href="<?php echo e(route('users.list.view')); ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('List View')); ?>"
                class="btn btn-sm btn-primary btn-icon ">
                <i class="ti ti-list"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user create')): ?>
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
                data-title="<?php echo e(__('Create New User')); ?>" data-url="<?php echo e(route('users.create')); ?>" data-bs-toggle="tooltip"
                data-bs-original-title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- [ Main Content ] start -->
    <div class="row">
        <div id="loading-bar-spinner" class="spinner"><div class="spinner-icon"></div></div>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary p-2 px-3 rounded"><?php echo e($user->type); ?></span>
                        </div>
                        <div class="card-header-right">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user manage')): ?>
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true">
                                        <i class="feather icon-more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user edit')): ?>
                                            <a data-url="<?php echo e(route('users.edit', $user->id)); ?>" class="dropdown-item"
                                                data-ajax-popup="true" data-title="<?php echo e(__('Update User')); ?>"
                                                data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user delete')): ?>
                                            <?php echo e(Form::open(['route' => ['users.destroy', $user->id], 'class' => 'm-0'])); ?>

                                            <?php echo method_field('DELETE'); ?>
                                            <a href="#!" class="dropdown-item bs-pass-para show_confirm" aria-label="Delete"
                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                data-confirm-yes="delete-form-<?php echo e($user->id); ?>">
                                                <i class="ti ti-trash"></i>
                                                <span><?php echo e(__('Delete')); ?></span>
                                            </a>
                                            <?php echo e(Form::close()); ?>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user reset password')): ?>
                                            <a href="#!" data-url="<?php echo e(route('users.reset', \Crypt::encrypt($user->id))); ?>"
                                                data-ajax-popup="true" data-size="md" class="dropdown-item"
                                                data-title="<?php echo e(__('Reset Password')); ?>"
                                                data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                                <i class="ti ti-adjustments"></i>
                                                <span> <?php echo e(__('Reset Password')); ?></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user login manage')): ?>
                                            <?php if($user->is_enable_login == 1): ?>
                                                <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                    class="dropdown-item">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-danger"> <?php echo e(__('Login Disable')); ?></span>
                                                </a>
                                            <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                                <a href="#" data-url="<?php echo e(route('users.reset', \Crypt::encrypt($user->id))); ?>"
                                                    data-ajax-popup="true" data-size="md" class="dropdown-item login_enable"
                                                    data-title="<?php echo e(__('New Password')); ?>" class="dropdown-item">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                    class="dropdown-item">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body  text-center">
                        <img src="<?php echo e(check_file($user->avatar) ? get_file($user->avatar) : get_file('uploads/users-avatar/avatar.png')); ?>"
                            alt="user-image" class="img-fluid rounded-circle" width="120px">
                        <h4 class="mt-2"><?php echo e($user->name); ?></h4>
                        <small><?php echo e($user->email); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(auth()->guard('web')->check()): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user create')): ?>
                <div class="col-md-3 All">
                    <a href="#" class="btn-addnew-project " style="padding: 90px 10px;" data-ajax-popup="true" data-size="md"
                        data-title="<?php echo e(__('Create New User')); ?>" data-url="<?php echo e(route('users.create')); ?>">
                        <div class="bg-primary proj-add-icon">
                            <i class="ti ti-plus my-2"></i>
                        </div>
                        <h6 class="mt-4 mb-2"><?php echo e(__('New User')); ?></h6>
                        <p class="text-muted text-center"><?php echo e(__('Click here to Create New User')); ?></p>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    
    <script>
        $(document).on('change', '#password_switch', function() {
            if ($(this).is(':checked')) {
                $('.ps_div').removeClass('d-none');
                $('#password').attr("required", true);

            } else {
                $('.ps_div').addClass('d-none');
                $('#password').val(null);
                $('#password').removeAttr("required");
            }
        });
        $(document).on('click', '.login_enable', function() {
            setTimeout(function() {
                $('.modal-body').append($('<input>', {
                    type: 'hidden',
                    val: 'true',
                    name: 'login_enable'
                }));
            }, 2000);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\QuantmHill\erp_system\resources\views/users/index.blade.php ENDPATH**/ ?>