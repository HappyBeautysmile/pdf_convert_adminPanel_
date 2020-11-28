<?php if(isset($isModelTranslatable) && $isModelTranslatable): ?>
    <div class="language-selector">
        <div class="btn-group btn-group-sm" role="group" data-toggle="buttons">
            <?php $__currentLoopData = config('voyager.multilingual.locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="btn btn-primary<?php echo e(($lang === config('voyager.multilingual.default')) ? " active" : ""); ?>">
                    <input type="radio" name="i18n_selector" id="<?php echo e($lang); ?>" autocomplete="off"<?php echo e(($lang === config('voyager.multilingual.default')) ? ' checked="checked"' : ''); ?>> <?php echo e(strtoupper($lang)); ?>

                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/multilingual/language-selector.blade.php ENDPATH**/ ?>