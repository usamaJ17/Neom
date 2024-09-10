<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between">
                    <h5 class="card-title"><?php echo app('translator')->get('Booked Rooms'); ?> </h5>
                    <span class="fw-bold">#<?php echo e($booking->booking_number); ?></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo app('translator')->get('SL'); ?></th>
                                    <th><?php echo app('translator')->get('Room Number'); ?></th>
                                    <th><?php echo app('translator')->get('Room Type'); ?></th>
                                    <th><?php echo app('translator')->get('Fare'); ?></th>
                                    <th><?php echo app('translator')->get('Cancellation Fee'); ?></th>
                                    <th><?php echo app('translator')->get('Refundable'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $booking->activeBookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookedRoom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($bookedRoom->room->room_number); ?></td>
                                        <td> <?php echo e($bookedRoom->room->room->roomType->name); ?></td>
                                        <td><?php echo e($general->cur_sym . showAmount($bookedRoom->fare)); ?></td>
                                        <td><?php echo e($general->cur_sym . showAmount($bookedRoom->cancellation_fee)); ?></td>
                                        <td><?php echo e($general->cur_sym . showAmount($bookedRoom->fare - $bookedRoom->cancellation_fee)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                            <tfoot>
                                <tr>
                                    <th class="text-end" colspan="4"><?php echo app('translator')->get('Total'); ?></th>
                                    <th><?php echo e($general->cur_sym . showAmount($booking->activeBookedRooms->sum('cancellation_fee'))); ?></th>
                                    <th><?php echo e($general->cur_sym . showAmount($booking->activeBookedRooms->sum('fare') - $booking->activeBookedRooms->sum('cancellation_fee'))); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="card-footer">
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.cancel.full')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <form action="<?php echo e(route('admin.booking.cancel.full', $booking->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Confirm Cancellation'); ?></button>
                        </form>
                    <?php endif ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/cancel.blade.php ENDPATH**/ ?>