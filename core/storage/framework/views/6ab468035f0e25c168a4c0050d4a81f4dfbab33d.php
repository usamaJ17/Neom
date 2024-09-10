<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                                     <!--<th><?php echo app('translator')->get('Room'); ?></th>-->
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bedAccessory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?>.</td>
                                        <td><?php echo e(__($item->name)); ?></td>
                                        <td><?php echo e(__($item->accommodation->name)); ?></td>
                                        <td><?php echo e(__($item->quantity)); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Update Bed Accessories'); ?>" data-resource="<?php echo e($item); ?>" type="button">
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                            <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.hotel.accessories.delete', $item->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure, you want to delete this bed?'); ?>" type="button">
                                                <i class="la la-trash"></i><?php echo app('translator')->get('Delete'); ?>
                                            </button>
                                        </td>
                                    </tr>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.hotel.accessories.save')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Name'); ?></label>
                                <input class="form-control" name="name" required type="text" value="<?php echo e(old('name')); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Quantity'); ?></label>
                                <input class="form-control" name="quantity" required type="number" value="<?php echo e(old('quantity')); ?>">
                            </div>
                            
                             <div class="form-group">
                                <label> <?php echo app('translator')->get('Accommodation'); ?></label>
                                       
                                    <select class="form-control"  name="accommodation_id" id="accommodation">
                                            <option disable selected value="">Select an Accommodation</option>
                                        <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                            </div>
                          
                            <div class="status"></div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Bed Accessories'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New '); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('#cuModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });

        })(jQuery);
    </script>
      <script>
            $(document).ready(function () {
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var room_id = $('#room_id');
        
                room_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('<?php echo e(route('admin.hotel.room.room', ['accommodation_id' => ':accommodation_id'])); ?>'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.room_number + '</option>');
                        });
        
                        room_id.prop('disabled', data.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                }
            });
        
            // Trigger the change event to populate amenities during edit
            // $('#accommodation').trigger('change');
            
    //          $(window).on('load', function() {
    //     $('#accommodation').trigger('change');
    // });
        });


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/bed_accessories/all.blade.php ENDPATH**/ ?>