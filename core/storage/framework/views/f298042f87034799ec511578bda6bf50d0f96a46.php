<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="show-filter mb-3 text-end">
                <button class="btn btn-outline--primary showFilterBtn btn-sm" type="button"><i class="las la-filter"></i> <?php echo app('translator')->get('Filter'); ?></button>
            </div>
            <div class="card responsive-filter-card mb-4">
                <div class="card-body">
                    <form action="">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Keywords'); ?> <i class="las la-info-circle text--info" title="<?php echo app('translator')->get('Search by booking number, username or email'); ?>"></i></label>
                                <input class="form-control" name="search" type="text" value="<?php echo e(request()->search); ?>">
                            </div>

                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Check In'); ?></label>
                                <input autocomplete="off" class="datepicker-here1 form-control" data-language="en" data-position='bottom right' data-range="false" name="check_in" type="text" value="<?php echo e(request()->check_in); ?>">
                            </div>

                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Checkout'); ?></label>
                                <input autocomplete="off" class="datepicker-here1 form-control" data-language="en" data-position='bottom right' data-range="false" name="check_out" type="text" value="<?php echo e(request()->check_out); ?>">
                            </div>

                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn--primary w-100 h-45"><i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
             <div class="card responsive-filter-card mb-4">
                 <div class="card-header">
                     <!-- <div class="flex-grow-1 align-self-end">-->
                     <!--           <button class="btn btn--primary w-10 h-45"><i class="fas fa-download"></i> <?php echo app('translator')->get('Download Templete'); ?></button>-->
                     <!--</div>-->
                      <a href="<?php echo e(route('admin.bookingTemplete')); ?>" class="btn btn--primary w-10 h-45">
        <i class="fas fa-download"></i> <?php echo app('translator')->get('Download Template'); ?>
    </a>
    <p><em>Use Checkin-Checkout format like (YYYY/MM/DD) </em></p>
                 </div>
                <div class="card-body">
                    
                    <form action="<?php echo e(route('admin.import.booking')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Import Booking Data'); ?> </label>
                                <input class="form-control" name="importFile" type="file">
                            </div>

                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn--primary w-100 h-45"><i class="fas fa-upload"></i> <?php echo app('translator')->get('Upload'); ?></button>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>

            <div class="card bg--transparent b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table bg-white" id="datatable">
                            <thead>
                                <tr>
                                    
                                    <th>SL.</th>
                                    <th><?php echo app('translator')->get('Booking Details'); ?></th>
                                    <th><?php echo app('translator')->get('Guest'); ?></th>
                                    <th><?php echo app('translator')->get('Check In'); ?> | <?php echo app('translator')->get('Check Out'); ?></th>
                                    <?php if(request()->routeIs('admin.booking.all') || request()->routeIs('admin.booking.active')): ?>
                                        <th><?php echo app('translator')->get('Status'); ?></th>
                                    <?php endif; ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="<?php if($booking->isDelayed() && !request()->routeIs('admin.booking.checkout.delayed')): ?> delayed-checkout <?php endif; ?>">

                                        <td>
                                            <?php echo e($loop->iteration); ?>

                                        </td>
                                        <td>
                                            <?php if($booking->key_status): ?>
                                                <span class="text--warning ">
                                                    <i class="las la-key f-size--24"></i>
                                                </span>
                                            <?php endif; ?>

                                            <span class="fw-bold">#<?php echo e($booking->booking_number); ?></span><br>
                                            <span class="fw-bold">Accommodation : <?php echo e($booking->accommodation->name); ?></span><br>
                                            <span class="fw-bold">Total Beds : <?php echo e($booking->bookedRooms->count()); ?></span><br>
                                            <em class="text-muted text--small"><?php echo e(showDateTime($booking->created_at, 'd M, Y h:i A')); ?></em><br>
                                            <hr>
                                            <?php $__currentLoopData = $booking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Bed Name : <?php echo e(__($item->room->room_number)); ?><br>
                                                Room Type : <?php echo e(optional($item->room->room->roomType)->name); ?><br>
                                                Room Number : <?php echo e($item->room->room->bed_name); ?>

                                            </span>
                                            <hr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <td>
                                            <?php if($booking->user_id): ?>
                                                <p class="fw-bold text--primary text-start">ID : <?php echo e($booking->user?->id); ?></p>
                                                <p class="fw-bold text--primary text-start">
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <a href="<?php echo e(route('admin.users.detail', $booking->user_id)); ?>">Username : <span>@</span><?php echo e(optional($booking->user)->username); ?></a>
                                                    <?php else: ?>
                                                        Username : <?php echo e(optional($booking->user)->username); ?>

                                                    <?php endif ?>
                                                </p>
                                                <p class="fw-bold text--primary text-start">Name : <?php echo e($booking->user?->firstname.' '.$booking->user?->lastname); ?></p>
                                                <p class="fw-bold text--primary text-start">SAP ID/ Employee ID : <?php echo e($booking->user?->employee_id); ?></p>
                                                <p class="fw-bold text--primary text-start">Nationality : <?php echo e($booking->user?->nationality); ?></p>
                                                <p class="fw-bold text--primary text-start">Passport/Iqama : <?php echo e($booking->user?->passport_no); ?></p>
                                                <p class="fw-bold text--primary text-start">Gender : <?php echo e($booking->user?->gender); ?></p>
                                                <p class="fw-bold text--primary text-start">Department : <?php echo e($booking->user?->department); ?></p>
                                                <p class="fw-bold text--primary text-start">Designation : <?php echo e($booking->user?->designation); ?></p>
                                                <p class="fw-bold text--primary text-start">Category : <?php echo e($booking->user?->category); ?></p>
                                                <p class="fw-bold text--primary text-start">Car Plate No : <?php echo e($booking->user?->car_no); ?></p>
                                                <p class="fw-bold text--primary text-start"><a href="tel:<?php echo e(optional($booking->user)->mobile); ?>">Contact Number : +<?php echo e(optional($booking->user)->mobile); ?></a></p>
                                                <p class="fw-bold text--primary text-start">Main Company : <?php echo e($booking->user?->company); ?></p>
                                                <p class="fw-bold text--primary text-start">Project Site : <?php echo e($booking->user?->project); ?></p>
                                            <?php else: ?>
                                                <span class="small"><?php echo e($booking->guest_details->name); ?></span>
                                                <br>
                                                <span class="fw-bold"><?php echo e(@$booking->guest_details->employee_id); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo e(showDateTime($booking->check_in, 'd M, Y')); ?>

                                            <?php if($booking->checked_out_at): ?>
                                            <br>
                                            <?php echo e(showDateTime($booking->checked_out_at, 'd M, Y')); ?>

                                            <?php endif; ?>
                                            <?php if($booking->status == 9): ?>
                                            <br>
                                            <?php
                                            $datework = \Carbon\Carbon::createFromDate($booking->check_in);
                                              $now = \Carbon\Carbon::parse($booking->checked_out_at);
                                              $testdate = $datework->diffInDays($now);
                                            ?>
                                            <p class="fw-bold text--primary">Total Stay : <?php echo e($testdate); ?> Days</p>
                                            <?php endif; ?>
                                        </td>

                                     

                                        <?php if(request()->routeIs('admin.booking.all') || request()->routeIs('admin.booking.active')): ?>
                                            <td>
                                                <?php if($booking->key_status && $booking->status == 1): ?>
                                                <small class="badge badge--success">Check In</small>
                                                <?php else: ?>
                                                <?php echo $booking->statusBadge; ?>
                                            <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php $hasPermission = App\Models\Role::hasPermission(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <td>
                                                <div class="d-flex justify-content-end flex-wrap gap-1">
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.details')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.booking.details', $booking->id)); ?>">
                                                            <i class="las la-desktop"></i><?php echo app('translator')->get('Details'); ?>
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if($booking->key_status && ($booking->status == 1 || $booking->status == 9)): ?>
                                                    <button class="btn btn-sm btn-outline--primary" data-bs-toggle="modal" data-bs-target="#checkout-<?php echo e($booking->id); ?>" type="button">
                                                        <i class="la la-pencil"></i><?php echo app('translator')->get('Edit Checkout'); ?>
                                                    </button>
                                                    <!--<button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="<?php echo app('translator')->get('Update Checkout'); ?>" data-id="<?php echo e($booking); ?>" type="button">-->
                                                    <!--    <i class="la la-pencil"></i><?php echo app('translator')->get('Edit Checkout'); ?>-->
                                                    <!--</button>-->
                                                    <?php endif; ?>

                                                    <button aria-expanded="false" class="btn btn-sm btn-outline--info" data-bs-toggle="dropdown" type="button">
                                                        <i class="las la-ellipsis-v"></i><?php echo app('translator')->get('More'); ?>
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
                                                                <?php if(now()->format('Y-m-d') >= $booking->check_in && now()->format('Y-m-d') < $booking->check_out && $booking->key_status == Status::DISABLE): ?>
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
                                                </div>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                    
                                    <div class="modal fade" id="checkout-<?php echo e($booking->id); ?>" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo app('translator')->get(' Checkout'); ?></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.bookingCheckout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                          
                           <input type="hidden" value="<?php echo e($booking->id); ?>" name="id">
                            <div class="form-group flex-fill">
                                    <label><?php echo app('translator')->get('Check Out Date'); ?></label>
                                    <input autocomplete="off" class="form-control bg--white" data-language="en" name="date" placeholder="<?php echo app('translator')->get('Select Date'); ?>" required type="date" value="<?php echo e($booking->checked_out_at?->format('Y-m-d')); ?>">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
            
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo app('translator')->get(' Checkout'); ?></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.bookingCheckout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                          
                           <input type="hidden" value="" name="id" id="id">
                            <div class="form-group flex-fill">
                                    <label><?php echo app('translator')->get('Check Out Date'); ?></label>
                                    <input autocomplete="off" class="form-control bg--white" data-language="en" name="date" placeholder="<?php echo app('translator')->get('Select Date'); ?>" required type="date">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    <?php echo $__env->make('admin.booking.partials.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php $hasPermission = App\Models\Role::hasPermission('admin.book.room')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn--primary" href="<?php echo e(route('admin.book.room')); ?>">
            <i class="la la-hand-o-right"></i><?php echo app('translator')->get('Book New'); ?>
        </a>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/global/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/global/css/vendor/datepicker.min.css')); ?>" rel="stylesheet">
    <style>
        .table td, .table th {
    border-top: 1px solid black !important;
}
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.datepicker-here1').datepicker({
                autoClose: true,
                dateFormat: "yyyy-mm-dd"
            });
            
          
        }

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .delayed-checkout {
            background-color: #ffefd640;
        }

        .table-responsive {
            min-height: 600px;
            background: transparent
        }

        .card {
            box-shadow: none;
        }
        .buttons-excel {
            display:none !important;
        }
    </style>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/list.blade.php ENDPATH**/ ?>