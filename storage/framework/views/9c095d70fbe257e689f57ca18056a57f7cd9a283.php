<?php if(is_field_translatable($dataTypeContent, $row)): ?>
    <input type="hidden"
           data-i18n="true"
           name="<?php echo e($row->field); ?>_i18n"
           id="<?php echo e($row->field); ?>_i18n"
           value="<?php echo e(get_field_translations($dataTypeContent, $row->field, $row->type, true)); ?>">
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/multilingual/input-hidden-bread-read.blade.php ENDPATH**/ ?>