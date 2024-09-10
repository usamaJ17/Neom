<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Complement'); ?></th>
                                    <th><?php echo app('translator')->get('Item'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.complement.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $complements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($complement->name); ?>

                                        </td>

                                        <td>
                                            <?php echo e(implode(', ', $complement->item)); ?>

                                        </td>
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.complement.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <td>
                                                <button class="btn btn-sm btn-outline--primary editBtn" data-action="<?php echo e(route('admin.hotel.complement.save', $complement->id)); ?>" data-complement="<?php echo e($complement); ?>">
                                                    <i class="la la-pencil"></i> <?php echo app('translator')->get('Edit'); ?>
                                                </button>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.complement.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <div class="modal fade" id="addModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Complement Name'); ?></label>
                                <input class="form-control" name="name" required type="text" value="<?php echo e(old('name')); ?>">
                            </div>

                            <div class="form-group">
                                <label class="required"> <?php echo app('translator')->get('Item'); ?></label>
                                <div class="d-flex">
                                    <div class="input-group row gx-0">
                                        <input type="text" class="form-control first-item" name=item[]" required>
                                    </div>
                                    <button class="btn btn--success input-group-text border-0 addItem flex-shrink-0 ms-4" type="button"><i class="las la-plus"></i></button>
                                </div>
                            </div>

                            <div class="append-item d-none"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.complement.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary addBtn" data-action="<?php echo e(route('admin.hotel.complement.save')); ?>" type="button"> <i class="las la-plus"></i><?php echo app('translator')->get('Add New '); ?></button>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
        <script>
            (function($) {
                "use strict";

                $('.addBtn').on('click', function() {
                    var modal = $('#addModal');
                    modal.find('.modal-title').text('<?php echo app('translator')->get('Add Complement'); ?>');
                    modal.find('form').attr('action', $(this).data('action'));
                    var divName = modal.find('.append-item');
                    divName.html('');
                    divName.addClass('d-none');
                    modal.modal('show');
                });

                $('.editBtn').on('click', function() {
                    var modal = $('#addModal');
                    modal.find('.modal-title').text('<?php echo app('translator')->get('Update Complement'); ?>')
                    var complement = $(this).data('complement');
                    modal.find('form').attr('action', $(this).data('action'));
                    modal.find('input[name=name]').val(complement.name);

                    var divName = modal.find('.append-item');
                    divName.html('');
                    divName.removeClass('d-none');

                    $.each(complement.item, function(index, element) {
                        if (index == 0) {
                            modal.find('.first-item').val(element);
                        } else {
                            divName.append(`
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="input-group row gx-0">
                                            <input type="text" class="form-control" name=item[]" value="${element}" required>
                                        </div>
                                        <button type="button" class="btn btn--danger input-group-text border-0 removeItem flex-shrink-0 ms-4"><i class="las la-times"></i></button>
                                    </div>
                                </div>
                            `);
                        }

                    });
                    modal.modal('show');
                });

                $(document).on('click', '.addItem', function() {
                    var modal = $(this).parents('.modal');
                    var div = modal.find('.append-item');
                    div.append(`
                    <div class="form-group">
                        <div class="d-flex">
                            <div class="input-group row gx-0">
                                <input type="text" class="form-control" name=item[]" required>
                            </div>
                            <button type="button" class="btn btn--danger input-group-text border-0 removeItem flex-shrink-0 ms-4"><i class="las la-times"></i></button>
                        </div>
                    </div>
                    `);
                    div.removeClass('d-none');
                });

                $(document).on('click', '.removeItem', function() {
                    $(this).parents('.form-group').remove();
                });

                $('#updateModal').on('shown.bs.modal', function(e) {
                    $(document).off('focusin.modal');
                });

                $('#addModal').on('shown.bs.modal', function(e) {
                    $(document).off('focusin.modal');
                });

            })(jQuery);
        </script>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/complement.blade.php ENDPATH**/ ?>