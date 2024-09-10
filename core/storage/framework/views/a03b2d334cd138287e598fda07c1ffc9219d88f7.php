<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <?php if(!blank($bookings)): ?>
            <div class="col-12">
                <div class="row gy-4">
                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $groupedBookings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                            <h4 class="mb-2"><?php echo e(showDateTime($date, 'd M, Y')); ?></h4>
                            <?php echo $__env->make('admin.booking.partials.booking_info_cards', ['bookings' => $groupedBookings, 'class' => 'bg--white'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(blank($bookings)): ?>
            <div class="col-12">
                <div class="card empty-card">
                    <div class="card-body">
                        <div class="text-center message">
                            <i class="las la-file la-3x"></i>
                            <h4><?php echo e(__($emptyMessage)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .empty-card h4 {
            color: #a5a5a5;
        }

        .message {
            font-size: 38px;
            color: #e9e9e9;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/upcoming_checkin_checkout.blade.php ENDPATH**/ ?>