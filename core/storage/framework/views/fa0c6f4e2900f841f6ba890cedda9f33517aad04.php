<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo app('translator')->get('Guest Info'); ?></h5>
        <div class="list">
            <div class="list-item">
                <span><?php echo app('translator')->get('Name'); ?></span>
                <span>
                    <?php if($booking->user_id): ?>
                        <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                            <a href="<?php echo e(route('admin.users.detail', $booking->user_id)); ?>"><?php echo e(__($booking->user->fullname)); ?></a>
                        <?php else: ?>
                            <?php echo e(__($booking->user->fullname)); ?>

                        <?php endif ?>
                    <?php else: ?>
                        <?php echo e($booking->guest_details->name); ?>

                    <?php endif; ?>
                </span>
            </div>
            <div class="list-item">
                <span><?php echo app('translator')->get('Phone'); ?></span>
                <span>
                    <?php if($booking->user_id): ?>
                        +<?php echo e($booking->user->mobile); ?>

                    <?php else: ?>
                        +<?php echo e($booking->guest_details->mobile); ?>

                    <?php endif; ?>
                </span>
            </div>
            <div class="list-item">
                <span><?php echo app('translator')->get('Address'); ?></span>
                <span>
                    <?php if($booking->user_id): ?>
                        <?php echo e($booking->user->address->address ?? 'N/A'); ?>

                    <?php else: ?>
                        <?php echo e($booking->guest_details->address ?? 'N/A'); ?>

                    <?php endif; ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/partials/guest_info.blade.php ENDPATH**/ ?>