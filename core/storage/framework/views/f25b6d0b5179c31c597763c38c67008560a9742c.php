<?php $__env->startSection('panel'); ?>

    <?php
        $availableOnly = request()->type && request()->type == 'not_booked';
    ?>

    <?php if(!$availableOnly): ?>
        <div class="row gy-4">
            <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if(isset($room->booking)): ?>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white">
                            <div class="widget-two__icon b-radius--5 bg--dark">
                                <?php echo e($room->room->room_number); ?>

                            </div>
                            <div class="widget-two__content d-flex align-items-center justify-content-between flex-wrap">
                                <?php if(isset($room->booking->user_id) && $room->booking->user_id != 0): ?>
                                    <h3>
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <a class="f-size--18 text-center text--dark" href="<?php echo e(route('admin.users.detail', $room->booking->user_id)); ?>">
                                                <?php echo e(__($room->booking->user->fullname)); ?>

                                            </a>
                                        <?php else: ?>
                                            <span class="f-size--18 text-center text--dark"><?php echo e(__($room->booking->user->fullname)); ?></span>
                                        <?php endif ?>
                                    </h3>
                                <?php else: ?>
                                    <h3 class="f-size--18 text--dark"><?php echo e(@$room->booking->guest_details->name); ?></h3>
                                <?php endif; ?>
                                <div class="d-flex flex-column fw-bold w-100">
                                    <p class="text--muted text--small"><?php echo app('translator')->get('Booking No.'); ?>:
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <a class="text--small fw-bold" href="<?php echo e(route('admin.booking.details', $room->booking->id)); ?>"><?php echo e($room->booking->booking_number); ?></a>
                                        <?php else: ?>
                                            <span class="fw-bold"><?php echo e($room->booking->booking_number); ?></span>
                                        <?php endif ?>
                                    </p>

                                    <p class="text--muted text--small"><?php echo app('translator')->get('Room Type'); ?>: <?php echo e(__($room->room?->roomType?->name)); ?>

                                    </p>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.extra.service.add')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <a class="btn btn--xs btn-outline--dark" data-services="<?php echo e($room->extraServices); ?>" href="<?php echo e(route('admin.extra.service.add')); ?>?room=<?php echo e($room->room->room_number); ?>"> <i class="la la-plus""></i><?php echo app('translator')->get('Add Service'); ?></a>
                                    <?php endif ?>

                                    <button class="btn btn--xs btn-outline--info btn-view" data-services="<?php echo e($room->extraServices); ?>" type="button"> <i class="la la-eye""></i><?php echo app('translator')->get('View Services'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text--muted"><?php echo app('translator')->get('No Room Booked Yet'); ?></h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if($emptyRooms->count()): ?>
        <?php if(!$availableOnly): ?>
            <h3 class="mt-5 mb-4"><?php echo app('translator')->get('Available for Booking'); ?></h3>
        <?php endif; ?>
        <div class="row gy-4">
            <?php $__currentLoopData = $emptyRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xxl-2 col-sm-2 col-3">

                    <div class="bg--white p-3 rounded text-center">
                        <span class="d-block fw-bold">
                            <?php echo e($room->room_number); ?>

                        </span>

                        <span class="text--small"><?php echo e(optional($room->roomType)->name); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if($availableOnly && blank($emptyRooms)): ?>
        <div class="col-12">
            <div class="card empty-card">
                <div class="card-body">
                    <div class="text-center message">
                        <i class="las la-file la-3x"></i>
                        <h4><?php echo app('translator')->get('No room available to book'); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="modelTitleId" class="modal fade" id="extraServices" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Extra Services'); ?></h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text--center"><?php echo app('translator')->get('No extra service yet.'); ?></h5>
                </div>
            </div>
        </div>
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

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            'use strict';
            $('.btn-view').on('click', function() {
                let modal = $('#extraServices');
                let services = $(this).data('services');

                console.log(services);

                let content = ``;
                if (services.length) {
                    content += `<ul class="list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="w-25"><?php echo app('translator')->get('Name'); ?></span>
                        <span class="w-25 text-center"><?php echo app('translator')->get('Qty'); ?></span>
                        <span class="w-25 text-center"><?php echo app('translator')->get('Price'); ?></span>
                        <span class="w-25 text-end"><?php echo app('translator')->get('Total'); ?></span>
                    </li>
                    `;

                    services.forEach((element, i) => {
                        content += `<li class="list-group-item d-flex justify-content-between">
                            <span class="w-25">${i+1}. ${element.extra_service.name}</span>
                            <span class="w-25 text-center">${element.qty}</span>
                            <span class="w-25 text-center"><?php echo e($general->cur_sym); ?>${parseFloat(element.unit_price)}</span>
                            <span class="w-25 text-end"><?php echo e($general->cur_sym); ?>${parseFloat(element.total_amount)}</span>
                        </li>`;
                    });

                    content += `</ul>`;
                } else {
                    content = `<h4 class="text-center"><?php echo app('translator')->get('No service used yet!'); ?></h4>`;
                }
                modal.find('.modal-body').html(content);

                modal.modal('show');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/todays_booked.blade.php ENDPATH**/ ?>