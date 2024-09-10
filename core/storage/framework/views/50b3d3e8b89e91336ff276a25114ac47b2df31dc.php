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
                                    <th><?php echo app('translator')->get('Bed Type Name'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                     <th><?php echo app('translator')->get('Accessory'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.*')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?>.</td>
                                        <td><?php echo e(__($item->name)); ?></td>
                                        <td><?php echo e(__($item->accommodation?->name)); ?></td>
                                        <td>
                                            <?php if($item->accessories_id): ?>
                                            <?php $__currentLoopData = json_decode($item->accessories_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $accessory = \App\Models\BedAccessory::find($row);
                                            ?>
                                            <span class="badge badge--success"><?php echo e($accessory?->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </td>
                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Update Bed'); ?>" data-resource="<?php echo e($item); ?>" type="button">
                                                    <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                </button>
                                            <?php endif ?>
                                            <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.delete')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <a class="btn btn-sm btn-outline--danger" href="<?php echo e(route('admin.hotel.newbed.delete', $item->id)); ?>" type="button">
                                                    <i class="la la-trash"></i><?php echo app('translator')->get('Delete'); ?>
                                                </a>
                                            <?php endif ?>
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

    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.hotel.newbed.save')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Name'); ?></label>
                                <input class="form-control" name="name" required type="text" value="<?php echo e(old('type_name')); ?>">
                            </div>
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('How many Adult'); ?></label>
                                <input class="form-control" name="adult" required type="text" value="<?php echo e(old('type_name')); ?>">
                            </div>
                             <div class="form-group">
                                <label> <?php echo app('translator')->get('Accommodation'); ?></label>
                                       
                                    <select class="form-control"  name="accommodation_id" id="accommodation" required>
                                            <option disable selected value="">Select an Accommodation</option>
                                        <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                            </div>
                             <div class="form-group">
                                <label> <?php echo app('translator')->get('Bed Accessories'); ?></label>
                                    <select multiple="multiple"  name="accessories_id[]" id="accessories_id" required>
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
    <?php endif ?>

    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.delete')  ? 1 : 0;
            if($hasPermission == 1): ?>
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
    <?php endif ?>
<?php $__env->stopSection(); ?>
<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Bed Type'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New '); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php endif ?>
<?php $__env->startPush('script'); ?>
    <!--<link rel="stylesheet" href="https://springstubbe.us/skins/default/styles/skin.css?1540571984" type ="text/css" />-->
<link rel="stylesheet" href="https://springstubbe.us/projects/jquery-multiselect/styles/index.css?1647360365" type ="text/css" />
<!--<link rel="stylesheet" href="https://springstubbe.us/skins/default/styles/skin_print.css?1431976655" type ="text/css" media="print" />-->
<!--<script type="text/javascript" src="https://springstubbe.us/skins/default/scripts/skin.js?1591798440"></script>-->
<script type="text/javascript" src="https://springstubbe.us/projects/jquery-multiselect/scripts/index.js?1647362994"></script>

    <script>
     $('select[multiple]').multiselect({
    search   : true,
    selectAll: true,
    texts    : {
        placeholder: 'Select Accessories',
        search     : 'Search Accessories'
    }
});
    </script>
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
                var options = [];
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var accessories_id = $('#accessories_id');
        
                accessories_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('<?php echo e(route('admin.accessories.get', ['accommodation_id' => ':accommodation_id'])); ?>'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data, function (key, value) {
                            // accessories_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                            options.push({
                                name   : value.name,
                                value  : value.id,
                            });
                        });
                        
                        $('select[multiple]').multiselect('loadOptions',options);
        
                        accessories_id.prop('disabled', data.length === 0);
                    });
                } else {
                    accessories_id.prop('disabled', true);
                }
            });
        
        });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/new_bed_type.blade.php ENDPATH**/ ?>