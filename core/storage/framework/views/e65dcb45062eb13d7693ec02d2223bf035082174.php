<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Room No'); ?></th>
                                    <th><?php echo app('translator')->get('Bed Name'); ?></th>
                                    <th><?php echo app('translator')->get('Bed Type'); ?></th>
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
                                        <td> <?php echo e($room->accommodation?->name); ?></td>
                                        <td> <?php echo e($room->room?->bed_name); ?></td>
                                        <td> <?php echo e($room->room_number); ?></td>
                                        <td><?php echo e(__($room->bedType?->name)); ?></td>
                                        <td> <?php echo $room->statusBadge ?> </td>
                                            <td>
                                                 <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="<?php echo app('translator')->get('Update Room'); ?>" data-resource="<?php echo e($room); ?>" type="button">
                                                        <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </button>
                                               
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <?php if($room->status == Status::ENABLE): ?>
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.status', $room->id)); ?>" data-question="<?php echo app('translator')->get('Are your to enable this room?'); ?>" type="button">
                                                        <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.status', $room->id)); ?>" data-question="<?php echo app('translator')->get('Are your to disable this room?'); ?>" type="button">
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



<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/rooms/occupied_vacant_rooms.blade.php ENDPATH**/ ?>