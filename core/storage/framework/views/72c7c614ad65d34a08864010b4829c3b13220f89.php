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
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                     <th><?php echo app('translator')->get('Room'); ?></th>
                                     <th><?php echo app('translator')->get('Room Type'); ?></th>
                                     <th><?php echo app('translator')->get('Bed'); ?></th>
                                     <th><?php echo app('translator')->get('Fine Items'); ?></th>
                                     <th><?php echo app('translator')->get('Damage Items'); ?></th>
                                     <th><?php echo app('translator')->get('Status'); ?></th>
                                      <th><?php echo app('translator')->get('Remarks'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $roomitem_inspections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inspections): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($inspections->id); ?></td>
                                        
                                        <td><?php echo e(__($inspections->admin->name)); ?></td>
                                        <td><?php echo e(__($inspections->accommodation->name)); ?></td>
                                        <td><?php echo e(__($inspections->room?->bed_name)); ?></td>
                                        <td><?php echo e(__($inspections->room?->roomType?->name)); ?></td>
                                        <td><?php echo e(__($inspections->bed?->room_number)); ?></td>
                                         <td>
                                            <?php if($inspections->room_item_id): ?>
                                            <?php $__currentLoopData = json_decode($inspections->room_item_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $item = \App\Models\RoomItem::find($row);
                                            ?>
                                            <span class="badge badge--success"><?php echo e($item?->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                         <td>
                                            <?php if($inspections->damage_room_item_id): ?>
                                            <?php $__currentLoopData = json_decode($inspections->damage_room_item_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $item = \App\Models\RoomItem::find($row);
                                            ?>
                                            <span class="badge badge--success"><?php echo e($item?->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(__($inspections->status)); ?></td>
                                        <td><?php echo e(__($inspections->remarks)); ?></td>
                                    </tr>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        </div>
    </div>

 <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.store')  ? 1 : 0;
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
                    <form action="<?php echo e(route('admin.hotel.room-item.store.inspection')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            
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
                                <label> <?php echo app('translator')->get('Room'); ?></label>
                                       
                                    <select class="form-control"  name="room_id" id="room_id" required>
                                            <option disable selected value="">Select Room</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Bed'); ?></label>
                                       
                                    <select class="form-control"  name="bed_id" id="bed_id" required>
                                            <option disable selected value="">Select Bed</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Fine Items'); ?></label>
                                       
                                    <select multiple="multiple"  name="room_item_id[]" id="room_item_id">
                                    </select>
                            </div>
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Damage Items'); ?></label>
                                       
                                    <select multiple="multiple"  name="damage_room_item_id[]" id="damage_room_item_id">
                                    </select>
                            </div>
                             <div class="form-group">
                                 <label for="status">Status</label>
                                    <div>
                                        <input type="radio" id="checkin" name="status" value="checkin" checked>
                                        <label for="checkin">Checkin</label>
                                
                                        <input type="radio" id="checkout" name="status" value="checkout">
                                        <label for="checkout">Checkout</label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea id="remarks" name="remarks" rows="4" cols="50"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>


    <!--<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.delete')  ? 1 : 0;
            if($hasPermission == 1): ?>-->
    <!--    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
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
<?php endif; ?>-->
    <!--<?php endif ?>-->
<?php $__env->stopSection(); ?>
<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('RoomItem Inspecction'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('RoomItem Inspecction '); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php endif ?>
<?php $__env->startPush('script'); ?>
<link rel="stylesheet" href="https://springstubbe.us/projects/jquery-multiselect/styles/index.css?1647360365" type ="text/css" />
<script type="text/javascript" src="https://springstubbe.us/projects/jquery-multiselect/scripts/index.js?1647362994"></script>

    <script>
     $('select[multiple]').multiselect({
    search   : true,
    selectAll: true,
    texts    : {
        placeholder: 'Select Items',
        search     : 'Search Items'
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
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var room_id = $('#room_id');
                var room_item_id = $('#room_item_id');
                var damage_room_item_id = $('#damage_room_item_id');
                var options = [];
        
                room_id.empty(); 
                room_item_id.empty(); 
                damage_room_item_id.empty(); 
        
                if (accommodationId) {
                    $.get('<?php echo e(route('admin.hotel.room.room', ['accommodation_id' => ':accommodation_id'])); ?>'.replace(':accommodation_id', accommodationId), function (data) {
                        room_id.append('<option value="">Select Bed</option>');
                        $.each(data.rooms, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.bed_name + '</option>');
                        });
                        $.each(data.items, function (key, value) {
                            // room_item_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                            options.push({
                                name   : value.name,
                                value  : value.id,
                            });
                        });
                        // $.each(data.items, function (key, value) {
                        //     damage_room_item_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                        // });
        
                        $('select[multiple]').multiselect('loadOptions',options);
                        room_id.prop('disabled', data.rooms.length === 0);
                        room_item_id.prop('disabled', data.items.length === 0);
                        damage_room_item_id.prop('disabled', data.items.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                    room_item_id.prop('disabled', true);
                    damage_room_item_id.prop('disabled', true);
                }
            });
            $('#room_id').change(function () {
                var room_id = $(this).val();
                var bed_id = $('#bed_id');
                bed_id.empty(); 
                if (room_id) {
                    $.get('<?php echo e(route('admin.bed.get', ['room_id' => ':room_id'])); ?>'.replace(':room_id', room_id), function (data) {
                        bed_id.append('<option value="">Select Bed</option>');
                        $.each(data, function (key, value) {
                            bed_id.append('<option value="' + value.id + '">' + value.room_number + '</option>');
                        });
                    bed_id.prop('disabled', data.length === 0);
                    });
                } else {
                    bed_id.prop('disabled', true);
                }
            });
        
        });


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/room_items/roon_item_inspection.blade.php ENDPATH**/ ?>