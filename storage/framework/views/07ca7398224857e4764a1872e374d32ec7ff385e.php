<?php if($data): ?>
    <?php
        // need to recreate object because policy might depend on record data
        $class = get_class($action);
        $action = new $class($dataType, $data);
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($action->getPolicy(), $data)): ?>
        <a href="<?php echo e($action->getRoute($dataType->name)); ?>" title="<?php echo e($action->getTitle()); ?>" <?php echo $action->convertAttributesToHtml(); ?>>
            <i class="<?php echo e($action->getIcon()); ?>"></i> <span class="hidden-xs hidden-sm"><?php echo e($action->getTitle()); ?></span>
        </a>
    <?php endif; ?>
<?php elseif(method_exists($action, 'massAction')): ?>
    <form method="post" action="<?php echo e(route('voyager.'.$dataType->slug.'.action')); ?>" style="display:inline">
        <?php echo e(csrf_field()); ?>

        <button type="submit" <?php echo $action->convertAttributesToHtml(); ?>><i class="<?php echo e($action->getIcon()); ?>"></i>  <?php echo e($action->getTitle()); ?></button>
        <input type="hidden" name="action" value="<?php echo e(get_class($action)); ?>">
        <input type="hidden" name="ids" value="" class="selected_ids">
    </form>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/bread/partials/actions.blade.php ENDPATH**/ ?>