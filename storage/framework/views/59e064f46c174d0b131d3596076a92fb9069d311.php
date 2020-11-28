<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            <?php $__env->startSection('breadcrumbs'); ?>
            <ol class="breadcrumb hidden-xs">
                <?php
                $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
                $url = route('voyager.dashboard');
                ?>
                <?php if(count($segments) == 0): ?>
                    <li class="active"><i class="voyager-boat"></i> <?php echo e(__('voyager::generic.dashboard')); ?></li>
                <?php else: ?>
                    <li class="active">
                        <a href="<?php echo e(route('voyager.dashboard')); ?>"><i class="voyager-boat"></i> <?php echo e(__('voyager::generic.dashboard')); ?></a>
                    </li>
                    <?php $__currentLoopData = $segments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $url .= '/'.$segment;
                        ?>
                        <?php if($loop->last): ?>
                            <li><?php echo e(ucfirst(urldecode($segment))); ?></li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($url); ?>"><?php echo e(ucfirst(urldecode($segment))); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ol>
            <?php echo $__env->yieldSection(); ?>
        </div>
        <ul class="nav navbar-nav <?php if(__('voyager::generic.is_rtl') == 'true'): ?> navbar-left <?php else: ?> navbar-right <?php endif; ?>">
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                   aria-expanded="false"><img src="<?php echo e($user_avatar); ?>" class="profile-img"> <span
                            class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="<?php echo e($user_avatar); ?>" class="profile-img">
                        <div class="profile-body">
                            <h5><?php echo e(Auth::user()->name); ?></h5>
                            <h6><?php echo e(Auth::user()->email); ?></h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    <?php if(is_array($nav_items) && !empty($nav_items)): ?>
                    <?php $__currentLoopData = $nav_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li <?php echo isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : ''; ?>>
                        <?php if(isset($item['route']) && $item['route'] == 'voyager.logout'): ?>
                        <form action="<?php echo e(route('voyager.logout')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <button type="submit" class="btn btn-danger btn-block">
                                <?php if(isset($item['icon_class']) && !empty($item['icon_class'])): ?>
                                <i class="<?php echo $item['icon_class']; ?>"></i>
                                <?php endif; ?>
                                <?php echo e(__($name)); ?>

                            </button>
                        </form>
                        <?php else: ?>
                        <a href="<?php echo e(isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#')); ?>" <?php echo isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : ''; ?>>
                            <?php if(isset($item['icon_class']) && !empty($item['icon_class'])): ?>
                            <i class="<?php echo $item['icon_class']; ?>"></i>
                            <?php endif; ?>
                            <?php echo e(__($name)); ?>

                        </a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/dashboard/navbar.blade.php ENDPATH**/ ?>