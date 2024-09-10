<div class="row gy-4">
    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xxl-3 col-xl-4 col-md-6">
            <div class="widget-two box--shadow2 b-radius--5 <?php echo e(@$class); ?>">
                <div class="widget-two__content d-flex align-items-end justify-content-between flex-wrap">
                    <?php if($booking->user_id): ?>
                        <h3>
                            <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a class="f-size--18 text-center text--dark" href="<?php echo e(route('admin.users.detail', $booking->user_id)); ?>"><i class="las la-user-circle"></i> <?php echo e(__($booking->user->fullname)); ?></a>
                            <?php else: ?>
                                <span class="f-size--18 text-center text--dark">
                                    <?php echo e(__($booking->user->fullname)); ?>

                                </span>
                            <?php endif ?>
                        </h3>
                    <?php else: ?>
                        <h3 class="f-size--18 text--dark"><i class="las la-user-circle"></i> <?php echo e(@$booking->guest_details->name); ?></h3>
                    <?php endif; ?>

                    <div class="d-flex flex-column fw-bold w-100">
                        <p class="text--muted text--small"><?php echo app('translator')->get('Mobile'); ?>:
                            <?php if($booking->user_id): ?>
                                +<?php echo e($booking->user->mobile); ?>

                            <?php else: ?>
                                +<?php echo e($booking->guest_details->mobile); ?>

                            <?php endif; ?>
                        </p>
                        <p class="text--muted text--small"><?php echo app('translator')->get('Booking No.'); ?>:
                            <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a class="text--small fw-bold" href="<?php echo e(route('admin.booking.details', $booking->id)); ?>"><?php echo e($booking->booking_number); ?></a>
                            <?php else: ?>
                                <span class="text--small fw-bold"><?php echo e($booking->booking_number); ?></span>
                            <?php endif ?>
                        </p>
                        <p class="text--muted text--small"><?php echo app('translator')->get('Total Rooms'); ?>: <?php echo e($booking->total_room); ?></p>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/partials/booking_info_cards.blade.php ENDPATH**/ ?>