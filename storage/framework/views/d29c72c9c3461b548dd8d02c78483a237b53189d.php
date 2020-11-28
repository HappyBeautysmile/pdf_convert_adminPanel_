<?php if(is_field_translatable($data, $row)): ?>
    <input type="hidden"
           data-i18n="true"
           name="<?php echo e($row->field.$row->id); ?>_i18n"
           id="<?php echo e($row->field.$row->id); ?>_i18n"
           value="<?php echo e(get_field_translations($data, $row->field)); ?>">
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/multilingual/input-hidden-bread-browse.blade.php ENDPATH**/ ?>