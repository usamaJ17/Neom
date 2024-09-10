<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N'); ?></th>
                                    <th><?php echo app('translator')->get('Bed Name'); ?></th>
                                    <th><?php echo app('translator')->get('Bed Type'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Room'); ?></th>
                                    <th><?php echo app('translator')->get('Bed Status'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($loop->iteration); ?></td>
                                        <td> <?php echo e($room->room_number); ?></td>
                                        <td> <?php echo e($room->bedType?->name); ?></td>
                                        <td><?php echo e(optional($room->accommodation)->name); ?></td>
                                        <td> <?php echo e($room->room?->bed_name); ?></td>
                                        <td>
                                            <?php if($room->roomStatus?->status == 'Awaiting Cleaning'): ?>
                                             <span class="badge badge--primary"><?php echo e($room->roomStatus?->status); ?></span> 
                                             <?php endif; ?>
                                             <?php if($room->roomStatus?->status == 'Under Maintenance'): ?>
                                             <span class="badge badge--warning"><?php echo e($room->roomStatus?->status); ?></span> 
                                             <?php endif; ?>
                                             <?php if($room->roomStatus?->status == 'Ready To Go'): ?>
                                             <span class="badge badge--success"><?php echo e($room->roomStatus?->status); ?></span> 
                                             <?php endif; ?>
                                            </td>
                                        <td> <?php echo $room->statusBadge ?> </td>
                                            <td>
                                                 <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="<?php echo app('translator')->get('Update Bed'); ?>" data-resource="<?php echo e($room); ?>" type="button">
                                                        <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </button>
                                                 <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.delete')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.delete', $room->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure, you want to delete this bed?'); ?>" type="button">
                                                    <i class="la la-trash"></i><?php echo app('translator')->get('Delete'); ?>
                                                </button>
                                            <?php endif ?>
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <?php if($room->status == Status::ENABLE): ?>
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.status', $room->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this bed?'); ?>" type="button">
                                                        <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.status', $room->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this bed?'); ?>" type="button">
                                                        <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                    </button>
                                                <?php endif; ?>
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
 <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
 <?php
        $bed_types = \App\Models\NewBedType::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        $new_rooms = \App\Models\BedType::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
    ?>
        
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                  
                    <form action="<?php echo e(route('admin.hotel.room.save')); ?>" method="POST">
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
                                    <label> <?php echo app('translator')->get('Select Room'); ?></label>
                                    <select class="form-control" name="room_id" id="room_id" required>
                                        <option disable selected value="">Select Room</option>
                                        <?php $__currentLoopData = $new_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->bed_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                <label> <?php echo app('translator')->get('Bed Name'); ?></label>
                                <input class="form-control" name="room_number" required type="text" value="<?php echo e(old('room_number')); ?>">
                            </div>
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Bed Type'); ?></label>
                                <select class="form-control"  name="bed_type_id" id="bed_type_id" required>
                                    <option disable selected value="">Select a Bed Type</option>
                                    <?php $__currentLoopData = $bed_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.status')  ? 1 : 0;
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


<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Bed'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New '); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php endif ?>
<?php $__env->startPush('script'); ?>

<script>
    
              $(document).ready(function () {
            $(document).ready(function () {
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var room_id = $('#room_id');
                var bed_type_id = $('#bed_type_id');
        
                room_id.empty(); // Clear the dropdown before appending options
                bed_type_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('<?php echo e(route('admin.room.get', ['accommodation_id' => ':accommodation_id'])); ?>'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data.beds, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.bed_name + '</option>');
                        });
                        
                        $.each(data.bedtypes, function (key, value) {
                            bed_type_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
        
                        room_id.prop('disabled', data.beds.length === 0);
                        bed_type_id.prop('disabled', data.bedtypes.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                    bed_type_id.prop('disabled', true);
                }
            });
        
        });
        });

    


</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/room_list.blade.php ENDPATH**/ ?>