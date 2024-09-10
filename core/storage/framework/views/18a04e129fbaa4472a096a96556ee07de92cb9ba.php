<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg--transparent b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table bg-white" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Booking No'); ?></th>
                                    <th><?php echo app('translator')->get('Bed Name'); ?></th>
                                    <th><?php echo app('translator')->get('Room Type'); ?></th>
                                    <th><?php echo app('translator')->get('Room Number'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Total Beds'); ?></th>
                                    <th><?php echo app('translator')->get('Category'); ?></th>
                                    <th><?php echo app('translator')->get('Guest Name'); ?></th>
                                    <th><?php echo app('translator')->get('SAP ID/Employee ID'); ?></th> 
                                    <th><?php echo app('translator')->get('Nationality'); ?></th> 
                                    <th><?php echo app('translator')->get('Passport/Iqama'); ?></th> 
                                    <th><?php echo app('translator')->get('Gender'); ?></th> 
                                    <th><?php echo app('translator')->get('Department'); ?></th> 
                                    <th><?php echo app('translator')->get('Designation'); ?></th> 
                                    <th><?php echo app('translator')->get('Contact Number'); ?></th> 
                                    <th><?php echo app('translator')->get('Main Company'); ?></th> 
                                    <th><?php echo app('translator')->get('Project Site'); ?></th> 
                                    <th><?php echo app('translator')->get('Check In'); ?></th>
                                    <th><?php echo app('translator')->get('Check Out'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Stay Duration Days'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr >
                                    <!--class="<?php if($booking->isDelayed() && !request()->routeIs('admin.booking.checkout.delayed')): ?> delayed-checkout <?php endif; ?>">-->
                                        
                                        <td>
                                            <span class="fw-bold">#<?php echo e($booking->booking_number); ?></span>
                                        </td>
                                         <td>
                                            <?php $__currentLoopData = $booking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Bed Name : <?php echo e(__($item->room->room_number)); ?><br>
                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                         <td>
                                            <?php $__currentLoopData = $booking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Room Type : <?php echo e(optional($item->room->room->roomType)->name); ?><br>
                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                         <td>
                                            <?php $__currentLoopData = $booking->bookedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="d-block fw-bold">
                                                Room Number : <?php echo e($item->room->room->bed_name); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td><?php echo e($booking->accommodation->name); ?></td>
                                        <td><?php echo e($booking->bookedRooms->count()); ?></td>
                                        <td><?php echo e($booking->user?->category); ?></td>
                                        <td><?php echo e($booking->user?->firstname.' '.$booking->user?->lastname); ?></td>
                                        <td><?php echo e($booking->user?->employee_id); ?></td>
                                        <td><?php echo e($booking->user?->nationality); ?></td>
                                        <td><?php echo e($booking->user?->passport_no); ?></td>
                                        <td><?php echo e($booking->user?->gender); ?></td>
                                        <td><?php echo e($booking->user?->department); ?></td>
                                        <td><?php echo e($booking->user?->designation); ?></td>
                                        <td><?php echo e($booking->user?->mobile); ?></td>
                                        <td><?php echo e($booking->user?->company); ?></td>
                                        <td><?php echo e($booking->user?->project); ?></td>
                                        <td><?php echo e(showDateTime($booking->checked_in_at, 'd M, Y')); ?></td>
                                        <td>
                                            <?php if($booking->checked_out_at <> ''): ?>
                                                <?php echo e(showDateTime($booking->checked_out_at, 'd M, Y')); ?>

                                           
                                            <?php endif; ?>
                                        </td>
                                            <td>
                                                <?php if($booking->status == 1): ?>
                                                <small class="badge badge--success">Active/Check In</small>
                                                <?php elseif($booking->status == 3): ?>
                                                <small class="badge badge--danger">Cancelled</small>
                                                <?php elseif($booking->status == 9 && $booking->sign <> ''): ?>
                                                <small class="badge badge--danger">Checked-out</small>
                                                <?php else: ?>
                                                
                                                <?php echo $booking->statusBadge; ?>
                                            <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($booking->checked_in_at <> '' && $booking->checked_out_at <> '' )
                                                {
                                                    $datework = \Carbon\Carbon::createFromDate($booking->checked_in_at);
                                                    $now = \Carbon\Carbon::parse($booking->checked_out_at);
                                                    $testdate = ($datework->diffInDays($now) + 1) . "Days";
                                                }
                                                else
                                                {
                                                 $testdate = "";
                                                }
                                                
                                            ?>
                                            <p class="fw-bold text--primary"><?php echo e($testdate); ?></p>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <style>
        .table td, .table th {
    border-top: 1px solid black !important;
}
    </style>
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
    </style>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/reports/booking.blade.php ENDPATH**/ ?>