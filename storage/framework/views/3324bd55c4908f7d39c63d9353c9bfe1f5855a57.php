<?php $__env->startSection('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular')); ?>

<?php $__env->startSection('page_header'); ?>
    <h1 class="page-title">
        <i class="<?php echo e($dataType->icon); ?>"></i> <?php echo e(__('voyager::generic.viewing')); ?> <?php echo e(ucfirst($dataType->getTranslatedAttribute('display_name_singular'))); ?> &nbsp;

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit', $dataTypeContent)): ?>
            <a href="<?php echo e(route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey())); ?>" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                <?php echo e(__('voyager::generic.edit')); ?>

            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $dataTypeContent)): ?>
            <?php if($isSoftDeleted): ?>
                <a href="<?php echo e(route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey())); ?>" title="<?php echo e(__('voyager::generic.restore')); ?>" class="btn btn-default restore" data-id="<?php echo e($dataTypeContent->getKey()); ?>" id="restore-<?php echo e($dataTypeContent->getKey()); ?>">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.restore')); ?></span>
                </a>
            <?php else: ?>
                <a href="javascript:;" title="<?php echo e(__('voyager::generic.delete')); ?>" class="btn btn-danger delete" data-id="<?php echo e($dataTypeContent->getKey()); ?>" id="delete-<?php echo e($dataTypeContent->getKey()); ?>">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm"><?php echo e(__('voyager::generic.delete')); ?></span>
                </a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('browse', $dataTypeContent)): ?>
        <a href="<?php echo e(route('voyager.'.$dataType->slug.'.index')); ?>" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            <?php echo e(__('voyager::generic.return_to_list')); ?>

        </a>
        <?php endif; ?>
    </h1>
    <?php echo $__env->make('voyager::multilingual.language-selector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    <?php $__currentLoopData = $dataType->readRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        if ($dataTypeContent->{$row->field.'_read'}) {
                            $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                        }
                        ?>
                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title"><?php echo e($row->getTranslatedAttribute('display_name')); ?></h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            <?php if(isset($row->details->view)): ?>
                                <?php echo $__env->make($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php elseif($row->type == "image"): ?>
                                <img class="img-responsive"
                                     src="<?php echo e(filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field})); ?>">
                            <?php elseif($row->type == 'multiple_images'): ?>
                                <?php if(json_decode($dataTypeContent->{$row->field})): ?>
                                    <?php $__currentLoopData = json_decode($dataTypeContent->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img class="img-responsive"
                                             src="<?php echo e(filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file)); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <img class="img-responsive"
                                         src="<?php echo e(filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field})); ?>">
                                <?php endif; ?>
                            <?php elseif($row->type == 'relationship'): ?>
                                 <?php echo $__env->make('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                                    !empty($row->details->options->{$dataTypeContent->{$row->field}})
                            ): ?>
                                <?php echo $row->details->options->{$dataTypeContent->{$row->field}};?>
                            <?php elseif($row->type == 'select_multiple'): ?>
                                <?php if(property_exists($row->details, 'relationship')): ?>

                                    <?php $__currentLoopData = json_decode($dataTypeContent->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($item->{$row->field}); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php elseif(property_exists($row->details, 'options')): ?>
                                    <?php if(!empty(json_decode($dataTypeContent->{$row->field}))): ?>
                                        <?php $__currentLoopData = json_decode($dataTypeContent->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(@$row->details->options->{$item}): ?>
                                                <?php echo e($row->details->options->{$item} . (!$loop->last ? ', ' : '')); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e(__('voyager::generic.none')); ?>

                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php elseif($row->type == 'date' || $row->type == 'timestamp'): ?>
                                <?php if( property_exists($row->details, 'format') && !is_null($dataTypeContent->{$row->field}) ): ?>
                                    <?php echo e(\Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format)); ?>

                                <?php else: ?>
                                    <?php echo e($dataTypeContent->{$row->field}); ?>

                                <?php endif; ?>
                            <?php elseif($row->type == 'checkbox'): ?>
                                <?php if(property_exists($row->details, 'on') && property_exists($row->details, 'off')): ?>
                                    <?php if($dataTypeContent->{$row->field}): ?>
                                    <span class="label label-info"><?php echo e($row->details->on); ?></span>
                                    <?php else: ?>
                                    <span class="label label-primary"><?php echo e($row->details->off); ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                <?php echo e($dataTypeContent->{$row->field}); ?>

                                <?php endif; ?>
                            <?php elseif($row->type == 'color'): ?>
                                <span class="badge badge-lg" style="background-color: <?php echo e($dataTypeContent->{$row->field}); ?>"><?php echo e($dataTypeContent->{$row->field}); ?></span>
                            <?php elseif($row->type == 'coordinates'): ?>
                                <?php echo $__env->make('voyager::partials.coordinates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php elseif($row->type == 'rich_text_box'): ?>
                                <?php echo $__env->make('voyager::multilingual.input-hidden-bread-read', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $dataTypeContent->{$row->field}; ?>

                            <?php elseif($row->type == 'file'): ?>
                                <?php if(json_decode($dataTypeContent->{$row->field})): ?>
                                    <?php $__currentLoopData = json_decode($dataTypeContent->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: ''); ?>">
                                            <?php echo e($file->original_name ?: ''); ?>

                                        </a>
                                        <br/>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <a href="<?php echo e(Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: ''); ?>">
                                        <?php echo e(__('voyager::generic.download')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo $__env->make('voyager::multilingual.input-hidden-bread-read', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <p><?php echo e($dataTypeContent->{$row->field}); ?></p>
                            <?php endif; ?>
                        </div><!-- panel-body -->
                        <?php if(!$loop->last): ?>
                            <hr style="margin:0;">
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>

    
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo e(__('voyager::generic.close')); ?>"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> <?php echo e(__('voyager::generic.delete_question')); ?> <?php echo e(strtolower($dataType->getTranslatedAttribute('display_name_singular'))); ?>?</h4>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo e(route('voyager.'.$dataType->slug.'.index')); ?>" id="delete_form" method="POST">
                        <?php echo e(method_field('DELETE')); ?>

                        <?php echo e(csrf_field()); ?>

                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="<?php echo e(__('voyager::generic.delete_confirm')); ?> <?php echo e(strtolower($dataType->getTranslatedAttribute('display_name_singular'))); ?>">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><?php echo e(__('voyager::generic.cancel')); ?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php if($isModelTranslatable): ?>
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
    <?php endif; ?>
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/bread/read.blade.php ENDPATH**/ ?>