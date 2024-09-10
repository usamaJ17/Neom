<?php $__env->startSection('panel'); ?>
    <?php
        $totalFare = $booking->bookedRooms->sum('fare');
        $totalTaxCharge = $booking->bookedRooms->sum('tax_charge');
        $canceledFare = $booking->bookedRooms->where('status', Status::ROOM_CANCELED)->sum('fare');
        $canceledTaxCharge = $booking->bookedRooms->where('status', Status::ROOM_CANCELED)->sum('tax_charge');
        $due = $booking->total_amount - $booking->paid_amount;
    ?>

    <div class="row gy-4">
        <div class="col-md-4 ">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">

                        <div>
                            <small class="fw-500"> <i class="las la-user-edit"></i> <?php echo app('translator')->get('Guest Type'); ?></small><br>
                            <?php if($booking->user_id): ?>
                                <span class="d-bock"><?php echo app('translator')->get('Registered Guest'); ?></span>
                            <?php else: ?>
                                <span class="d-bock"><?php echo app('translator')->get('Walk In Guest'); ?></span>
                            <?php endif; ?>
                        </div>

                        <div>

                            <small class="fw-500"> <i class="la la-user"></i> <?php echo app('translator')->get('Name'); ?></small><br>
                            <?php if($booking->user_id): ?>
                                <a class="fw-bold d-block text--primary" href="<?php echo e(can('admin.users.detail') ? route('admin.users.detail', $booking->user_id) : 'javascript:void(0)'); ?>"><?php echo e(optional($booking->user)->fullname); ?></a>
                            <?php else: ?>
                                <span class="d-block"><?php echo e($booking->guest_details->name); ?></span>
                            <?php endif; ?>
                        </div>

                        <!--<div>-->
                        <!--    <small class="fw-500"><i class="la la-envelope"></i> <?php echo app('translator')->get('Email'); ?></small><br>-->
                        <!--    <?php if($booking->user_id): ?>-->
                        <!--        <span class="d-block"><?php echo e(optional($booking->user)->email); ?></span>-->
                        <!--    <?php else: ?>-->
                        <!--        <span class="d-block"><?php echo e(@$booking->guest_details->email); ?></span>-->
                        <!--    <?php endif; ?>-->
                        <!--</div>-->
                        <div>
                            <small class="fw-500"><i class="la la-envelope"></i> <?php echo app('translator')->get('SAP ID/Employee ID'); ?></small><br>
                            <?php if($booking->user_id): ?>
                                <span class="d-block"><?php echo e(optional($booking->user)->employee_id); ?></span>
                            <?php else: ?>
                                <span class="d-block"><?php echo e(@$booking->guest_details->employee_id); ?></span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <small class="fw-500"><i class="la la-envelope"></i> <?php echo app('translator')->get('Car Plate No'); ?></small><br>
                            <?php if($booking->user_id): ?>
                                <span class="d-block"><?php echo e(optional($booking->user)->car_no); ?></span>
                            <?php else: ?>
                                <span class="d-block"><?php echo e(@$booking->guest_details->car_no); ?></span>
                            <?php endif; ?>
                        </div>

                        <div>
                            <small class="fw-500"><i class="la la-mobile"></i> <?php echo app('translator')->get('Mobile'); ?></small>

                            <span class="d-block">
                                <?php if($booking->user_id): ?>
                                    +<?php echo e(optional($booking->user)->mobile); ?>

                                <?php else: ?>
                                    +<?php echo e($booking->guest_details->mobile); ?>

                                <?php endif; ?>
                            </span>
                        </div>

                        <?php
                            $address = $booking->user_id ? optional($booking->user)->address : @$booking->guest_details->address;
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="custom-badge position-absolute">
                        <?php
                            echo $booking->status_badge;
                        ?>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between gap-3">
                        <div class="d-flex flex-column gap-3">
                            <div>
                                <small class="fw-500"><?php echo app('translator')->get('Booking No.'); ?></small> <br>
                                <span>#<?php echo e($booking->booking_number); ?></span>
                            </div>
                            
                            <?php if($booking->sign): ?>
                            
                            <div>
                                <small class="fw-500"><?php echo app('translator')->get('Signature'); ?></small> <br>
                                <span><img src="<?php echo e(asset('assets/images/seo/'.$booking->sign)); ?>"></span>
                            </div>
                            
                            <?php endif; ?>


                            <!--<div>-->
                            <!--    <small class="fw-500"><?php echo app('translator')->get('Total Room'); ?></small> <br>-->
                            <!--    <span><?php echo e($booking->bookedRooms->count()); ?></span>-->
                            <!--</div>-->

                            <!--<div>-->
                            <!--    <small class="fw-500"><?php echo app('translator')->get('Total Charge'); ?></small> <br>-->
                            <!--    <span><?php echo e(showAmount($booking->total_amount)); ?> <?php echo e(__($general->cur_text)); ?></span>-->
                            <!--</div>-->

                            <!--<div>-->
                            <!--    <small class="fw-500"><?php echo app('translator')->get('Paid Amount'); ?></small> <br>-->
                            <!--    <span><?php echo e(showAmount($booking->paid_amount)); ?> <?php echo e(__($general->cur_text)); ?></span>-->
                            <!--</div>-->

                            <!--<div>-->
                            <!--    <?php if($due < 0): ?>-->
                            <!--        <small class="fw-500"><?php echo app('translator')->get('Refundable'); ?> </small> <br>-->
                            <!--        <span class="text--warning"><?php echo e($general->cur_sym . showAmount(abs($due))); ?></span>-->
                            <!--    <?php else: ?>-->
                            <!--        <small class="fw-500"><?php echo app('translator')->get('Receivable from User'); ?></small><br>-->
                            <!--        <span class="<?php if($due > 0): ?> text--danger <?php else: ?> text--success <?php endif; ?>"> <?php echo e($general->cur_sym . showAmount(abs($due))); ?></span>-->
                            <!--    <?php endif; ?>-->
                            <!--</div>-->
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <div>
                                <small class="fw-500"><?php echo app('translator')->get('Booked At'); ?></small> <br>
                                <small> <em class="text-muted"><?php echo e(showDateTime($booking->check_in, 'd M, Y h:i A')); ?></em></small>
                            </div>

                            <div>
                                <small class="fw-500"><?php echo app('translator')->get('Check-In'); ?></small> <br>
                                <small><em><?php echo e(showDateTime($booking->check_in, 'd M, Y h:i A')); ?></em></small>
                            </div>

                            <!--<div>-->
                            <!--    <small class="fw-500"><?php echo app('translator')->get('Checkout'); ?></small> <br>-->
                            <!--    <small><em><?php echo e(showDateTime($booking->check_out, 'd M, Y')); ?></em></small>-->
                            <!--</div>-->

                            <!--<div>-->
                            <!--    <small class="fw-500"><?php echo app('translator')->get('Checked-In At'); ?></small> <br>-->
                            <!--    <small> <em class="text-muted"><?php echo e(showDateTime($booking->checked_in_at, 'd M, Y h:i A')); ?></em></small>-->
                            <!--</div>-->
                            <div>
                                <small class="fw-500"><?php echo app('translator')->get('Checked Out At'); ?></small> <br>
                                <small> <em class="text-muted">
                                        <?php if($booking->checked_out_at): ?>
                                            <?php echo e(showDateTime($booking->checked_out_at, 'd M, Y h:i A')); ?>

                                        <?php else: ?>
                                            <?php echo app('translator')->get('N/A'); ?>
                                        <?php endif; ?>
                                    </em>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

















































































































































































































































































































        <?php echo $__env->make('admin.booking.partials.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopSection(); ?>

    <?php $hasPermission = App\Models\Role::hasPermission(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice', 'admin.booking.all'])  ? 1 : 0;
            if($hasPermission == 1): ?>
        <?php $__env->startPush('breadcrumb-plugins'); ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <a class="btn btn-sm btn--primary" href="<?php echo e(route('admin.booking.all')); ?>">
                    <i class="la la-list"></i><?php echo app('translator')->get('All Bookings'); ?>
                </a>
            <?php endif ?>

            <button aria-expanded="false" class="btn btn-sm btn--info dropdown-toggle" data-bs-toggle="dropdown" type="button">
                <i class="la la-ellipsis-v"></i><?php echo app('translator')->get('More'); ?>
            </button>

            <div class="dropdown-menu">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.booked.rooms')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <a class="dropdown-item" href="<?php echo e(route('admin.booking.booked.rooms', $booking->id)); ?>">
                        <i class="las la-desktop"></i> <?php echo app('translator')->get('Booked Rooms'); ?>
                    </a>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.service.details')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <a class="dropdown-item" href="<?php echo e(route('admin.booking.service.details', $booking->id)); ?>">
                        <i class="las la-server"></i> <?php echo app('translator')->get('Extra Services'); ?>
                    </a>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.payment')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <a class="dropdown-item" href="<?php echo e(route('admin.booking.payment', $booking->id)); ?>">
                        <i class="la la-money-bill"></i> <?php echo app('translator')->get('Payment'); ?>
                    </a>
                <?php endif ?>

                <?php if($booking->status == Status::BOOKING_ACTIVE): ?>
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.key.handover')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <?php if(now()->format('Y-m-d') >= $booking->check_in && $booking->key_status == Status::DISABLE): ?>
                            <a class="dropdown-item handoverKeyBtn" data-booked_rooms="<?php echo e($booking->activeBookedRooms->unique('room_id')); ?>" data-id="<?php echo e($booking->id); ?>" href="javascript:void(0)">
                                <i class="las la-key"></i> <?php echo app('translator')->get('Handover Keys'); ?>
                            </a>
                        <?php endif; ?>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.merge')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <a class="dropdown-item mergeBookingBtn" data-booking_number="<?php echo e($booking->booking_number); ?>" data-id="<?php echo e($booking->id); ?>" href="javascript:void(0)">
                            <i class="las la-object-group"></i> <?php echo app('translator')->get('Merge Booking'); ?>
                        </a>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.cancel')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <a class="dropdown-item" href="<?php echo e(route('admin.booking.cancel', $booking->id)); ?>">
                            <i class="las la-times-circle"></i> <?php echo app('translator')->get('Cancel Booking'); ?>
                        </a>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.checkout')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <?php if(now() >= $booking->check_out): ?>
                            <a class="dropdown-item" href="<?php echo e(route('admin.booking.checkout', $booking->id)); ?>">
                                <i class="la la-sign-out"></i> <?php echo app('translator')->get('Check Out'); ?>
                            </a>
                        <?php endif; ?>
                    <?php endif ?>
                <?php endif; ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.invoice')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <a class="dropdown-item" href="<?php echo e(route('admin.booking.invoice', $booking->id)); ?>" target="_blank"><i class="las la-print"></i> <?php echo app('translator')->get('Print Invoice'); ?></a>
                <?php endif ?>
            </div>

        <?php $__env->stopPush(); ?>
    <?php endif ?>

    <?php $__env->startPush('style'); ?>
        <style>
            .custom-badge {
                top: -15px;
                left: calc(50% - 75px)
            }

            .custom-badge .badge {
                width: 150px;
                height: 30px;
                line-height: 24px;
                font-size: 1rem !important;
                font-weight: 500;
            }

            .table-striped>tbody>tr:nth-of-type(odd)>* {
                --bs-table-accent-bg: rgb(255 255 255 / 37%);
            }

            .custom--table thead th {
                background-color: #d9d9d9;
            }

            .custom--table th,
            .custom--table td {
                border: 1px solid #e8e8e8;
            }

            .custom--table {
                border: 1px solid #e8e8e8;
                border-collapse: collapse;
            }

            .custom--table tbody td:first-child {
                text-align: center;
            }

            .custom--table tbody td,
            .custom--table thead th {
                color: #5b6e88 !important;
            }

            @media (min-width: 768px) {
                .custom--table tbody td {
                    padding: 0.5rem 1rem !important;
                }

                .custom--table thead th {
                    padding: 1rem !important;
                }
            }

            .accordion-button:focus {
                box-shadow: none;
            }

            .accordion-button:not(.collapsed) {
                color: #fff;
                background-color: #071251;
                font-weight: bold;
            }

            .list-group-item:nth-of-type(odd) {
                background-color: #f9f9f9f2;
            }

            .accordion-button:not(.collapsed)::after {
                filter: brightness(0) invert(1);
            }

            table thead th:first-child {
                border-radius: 0;
            }

            .accordion-item:first-of-type .accordion-button {
                border-radius: unset;
            }

            .accordion-item:has(table) {
                border: 0;
            }
        </style>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/details.blade.php ENDPATH**/ ?>