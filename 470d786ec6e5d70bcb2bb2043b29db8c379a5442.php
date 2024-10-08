<ul class="dash-submenu">
    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
                $staus = true;
                if(!empty($child->dependency))
                {
                    $dependency = explode(',',$child->dependency);
                    $staus = false;
                    if(!empty($active_module))
                    {
                        if(!empty(array_intersect($dependency,$active_module)))
                        {
                            $staus = true;
                        }
                    }
                }
                if(!empty($child->disable_module))
                {
                    $disable_module = explode(',',$child->disable_module);
                    $staus = false;
                    if(!empty($active_module))
                    {
                        if(count(array_intersect($disable_module, $active_module)) != count($disable_module))
                        {
                            $staus = true;
                        }
                    }
                }
        ?>
        <?php if($staus == true): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($child->permissions)): ?>
            <?php if(($child->title != "Sub-Ordinates" && $child->title != "Locations" && $child->title != "Resigned Employee") || (auth()->user()->managedUsers()->exists() || strcasecmp(auth()->user()->type, "company") == 0 || strcasecmp(auth()->user()->type, "hr") == 0)): ?>
            <li class="dash-item">
                <a class="dash-link" href="<?php echo e(empty($child->route) ? '#' : route($child->route)); ?>">
                    <?php echo e(__($child->title)); ?>

                    <?php if(count($child->childs)): ?>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    <?php endif; ?>
                </a>
                <?php echo $__env->make('partials.submenu', ['childs' => $child->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
            <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH D:\QuantmHill\erp_system\resources\views/partials/submenu.blade.php ENDPATH**/ ?>