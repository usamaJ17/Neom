<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Guest Name'); ?></th>
                                    <th><?php echo app('translator')->get('Prev Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Current Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Prev Booking'); ?></th>
                                    <th><?php echo app('translator')->get('Prev Booking Bed Name'); ?></th>
                                    <th><?php echo app('translator')->get('Prev Booking Room Type'); ?></th>
                                    <th><?php echo app('translator')->get('Prev Booking Bed Number'); ?></th>
                                    <th><?php echo app('translator')->get('Current Booking'); ?></th>
                                    <th><?php echo app('translator')->get('Current Booking Bed Name'); ?></th>
                                    <th><?php echo app('translator')->get('Current Booking Room Type'); ?></th>
                                    <th><?php echo app('translator')->get('Current Booking Bed Number'); ?></th>
                                    <th><?php echo app('translator')->get('Booked'); ?></th>
                                    <th><?php echo app('translator')->get('Transfer By'); ?></th>
                                    <th><?php echo app('translator')->get('Transfer Date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $transferStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($staff->user->firstname.' '.$staff->user->lastname); ?></td>
                                        <td><?php echo e($staff->preaccommodation?->name); ?></td>
                                        <td><?php echo e($staff->accommodation?->name); ?></td>
                                        <td>
                                            <?php if($staff->prevBooking): ?>
                                            <?php echo e($staff->prevBooking->booking_number); ?><br>
                                            <span class="fw-bold">Total Beds : <?php echo e($staff->prevBooking->bookedRooms->count()); ?></span><br>
                                            <?php if($staff->prevBooking->key_status): ?>
                                                <small class="badge badge--success">Check In</small>
                                                <?php else: ?>
                                                <?php echo $staff->prevBooking->statusBadge; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->prevBooking): ?>
                                            <?php $__currentLoopData = $staff->prevBooking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Bed Name : <?php echo e(__($item->room->room_number)); ?><br>
                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->prevBooking): ?>
                                            <?php $__currentLoopData = $staff->prevBooking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Room Type : <?php echo e(optional($item->room->room->roomType)->name); ?><br>
                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->prevBooking): ?>
                                            <?php $__currentLoopData = $staff->prevBooking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Room Number : <?php echo e($item->room->room->bed_name); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->user?->booking()->where('status',1)->latest()->first()): ?>
                                            <?php echo e($staff->user?->booking()->where('status',1)->latest()->first()->booking_number); ?><br>
                                            <span class="fw-bold">Total Beds : <?php echo e($staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms->count()); ?></span><br>
                                            <?php if($staff->user?->booking()->where('status',1)->latest()->first()->key_status): ?>
                                                <small class="badge badge--success">Check In</small>
                                                <?php else: ?>
                                                <?php echo $staff->user?->booking()->where('status',1)->latest()->first()->statusBadge; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->user?->booking()->where('status',1)->latest()->first()): ?>
                                            <?php $__currentLoopData = $staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Bed Name : <?php echo e(__($item->room->room_number)); ?><br>
                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->user?->booking()->where('status',1)->latest()->first()): ?>
                                            <?php $__currentLoopData = $staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Room Type : <?php echo e(optional($item->room->room->roomType)->name); ?><br>
                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($staff->user?->booking()->where('status',1)->latest()->first()): ?>
                                            <?php $__currentLoopData = $staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Room Number : <?php echo e($item->room->room->bed_name); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($staff->is_booked ? 'Yes': 'No'); ?></td>
                                        <td><?php echo e($staff->admin->name); ?></td>
                                        <td><?php echo e($staff->transfer_date); ?></td>
                                       
                                    </tr>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
               
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

    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <!-- Create Update Modal -->
        <div class="modal fade" id="cuModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="<?php echo e(route('admin.users.transferSave')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">

                             <div class="form-group">
                                <label><?php echo app('translator')->get('Guest'); ?></label>
                                <select class="form-control" name="staff_id" required>
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $allStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($staff->id); ?>">Guest : <?php echo e($staff->firstname); ?> <?php echo e($staff->lastname); ?> - Current : <?php echo e($staff->accommodation?->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                          
                            
                             <div class="form-group">
                                <label><?php echo app('translator')->get('Accommodation'); ?></label>
                                <select class="form-control" name="accommodation_id" required>
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Transfer Date'); ?></label>
                                <input class="form-control" name="transfer_date" required type="date">
                            </div>

                        </div>
                        <div class="align-items-center d-flex justify-content-between p-3">
                            <input class="btn btn--primary" name="type" value="Transfer without booking" type="submit">
                            <input class="btn btn--primary" value="Transfer with booking" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cuModal2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">In Building Transfer Guest</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="<?php echo e(route('admin.users.transferSave')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">

                             <div class="form-group">
                                <label><?php echo app('translator')->get('Guest'); ?></label>
                                <select class="form-control" name="staff_id" required id="user_id" onchange="getBookings()">
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $allStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($staff->id); ?>">Guest : <?php echo e($staff->firstname); ?> <?php echo e($staff->lastname); ?> - Current : <?php echo e($staff->accommodation?->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                          
                            
                             <div class="form-group">
                                <label><?php echo app('translator')->get('Booking'); ?></label>
                                <select class="form-control" name="booking_id" id="booking_id" required>
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Transfer Date'); ?></label>
                                <input class="form-control" name="transfer_date" required type="date">
                            </div>

                        </div>
                        <div class="align-items-center d-flex justify-content-end p-3">
                            <input class="btn btn--primary" value="Transfer" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>

    <!-- Modal Trigger Button -->
    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.transferSave')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <button class="btn btn-sm btn-outline--primary" data-bs-toggle="modal" data-bs-target="#cuModal2" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('In Building Transfer Guest'); ?>
        </button>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Transfer Guest'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Transfer Guest'); ?>
        </button>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <style>
        .table td, .table th {
    border-top: 1px solid black !important;
}
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<script>
            function getBookings(){
                var staffId = $('#user_id').val();
                var booking_id = $('#booking_id');
        
                booking_id.empty(); // Clear the dropdown before appending options
        
                if (staffId) {
                    $.get('/admin/get-bookings/:staff_id'.replace(':staff_id', staffId), function (data) {
                        $.each(data, function (key, value) {
                            booking_id.append('<option value="' + value.id + '">' + value.booking_number + '</option>');
                        });
                        booking_id.prop('disabled', data.length === 0);
                    });
                } else {
                    booking_id.prop('disabled', true);
                }
            };
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/users/trasnferUser.blade.php ENDPATH**/ ?>