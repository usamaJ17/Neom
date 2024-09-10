<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-12">
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--info overflow-hidden">
                        <a class="item-link" href="<?php if(can('admin.booking.all')): ?> <?php echo e(route('admin.booking.all')); ?>?search=<?php echo e($user->username); ?> <?php else: ?> javascript:void(0) <?php endif; ?>"></a>
                        <div class="widget-two__icon b-radius--5 bg--info">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white"><?php echo e($widget['total_bookings']); ?></h3>
                            <p class="text-white"><?php echo app('translator')->get('Total Bookings'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--success overflow-hidden">
                        <a class="item-link" href="<?php if(can('admin.booking.active')): ?> <?php echo e(route('admin.booking.active')); ?>?search=<?php echo e($user->username); ?> <?php else: ?> javascript:void(0) <?php endif; ?>"></a>
                        <div class="widget-two__icon b-radius--5 bg--success">
                            <i class="las la-ban"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white"><?php echo e($widget['running_bookings']); ?></h3>
                            <p class="text-white"><?php echo app('translator')->get('Running Bookings'); ?></p>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->

                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--warning">
                        <a class="item-link" href="<?php if(can('admin.request.booking.all')): ?> <?php echo e(route('admin.request.booking.all')); ?>?search=<?php echo e($user->username); ?> <?php else: ?> javascript:void(0) <?php endif; ?>"></a>
                        <div class="widget-two__icon b-radius--5 bg--warning">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white"><?php echo e($widget['booking_requests']); ?></h3>
                            <p class="text-white"><?php echo app('translator')->get('Booking Request'); ?></p>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->

                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--3">
                        <a class="item-link" href="<?php if(can('admin.report.payments.received')): ?> <?php echo e(route('admin.report.payments.received')); ?>?search=<?php echo e($user->username); ?> <?php else: ?> javascript:void(0) <?php endif; ?>"></a>
                        <div class="widget-two__icon b-radius--5 bg--3">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white"><?php echo e($general->cur_sym . showAmount($widget['total_payment'])); ?></h3>
                            <p class="text-white"><?php echo app('translator')->get('Total Payment'); ?></p>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->
            </div>
        </div>

        <div class="col-12">
            <div class="row gy-4">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.notification.log')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <a class="btn btn--primary btn--shadow w-100 btn-lg" href="<?php echo e(route('admin.users.notification.log', $user->id)); ?>">
                            <i class="las la-bell"></i><?php echo app('translator')->get('Notifications'); ?>
                        </a>
                    </div>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.login.history')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <a class="btn btn--info btn--shadow w-100 btn-lg" href="<?php echo e(route('admin.report.login.history')); ?>?search=<?php echo e($user->username); ?>">
                            <i class="las la-list-alt"></i><?php echo app('translator')->get('Logins'); ?>
                        </a>
                    </div>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.login')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <a class="btn btn--dark btn--shadow w-100 btn-lg" href="<?php echo e(route('admin.users.login', $user->id)); ?>" target="_blank">
                            <i class="las la-sign-in-alt"></i><?php echo app('translator')->get('Login as Guest'); ?>
                        </a>
                    </div>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <?php if($user->status == Status::USER_ACTIVE): ?>
                            <button class="btn btn--warning btn--gradi btn--shadow w-100 btn-lg userStatus" data-bs-target="#userStatusModal" data-bs-toggle="modal" type="button">
                                <i class="las la-ban"></i><?php echo app('translator')->get('Ban User'); ?>
                            </button>
                        <?php else: ?>
                            <button class="btn btn--success btn--gradi btn--shadow w-100 btn-lg userStatus" data-bs-target="#userStatusModal" data-bs-toggle="modal" type="button">
                                <i class="las la-check"></i><?php echo app('translator')->get('Unban User'); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo app('translator')->get('Information of'); ?> <?php echo e($user->fullname); ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.users.update', [$user->id])); ?>" enctype="multipart/form-data" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('First Name'); ?></label>
                                    <input class="form-control" name="firstname" required type="text" value="<?php echo e($user->firstname); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Last Name'); ?></label>
                                    <input class="form-control" name="lastname" required type="text" value="<?php echo e($user->lastname); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Email'); ?></label>
                                    <input class="form-control" name="email" required type="email" value="<?php echo e($user->email); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Mobile Number'); ?> </label>
                                    <div class="input-group">
                                        <span class="input-group-text mobile-code"></span>
                                        <input class="form-control checkUser" id="mobile" name="mobile" required type="number" value="<?php echo e(old('mobile')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Address'); ?></label>
                                    <input class="form-control" name="address" type="text" value="<?php echo e(@$user->address->address); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('City'); ?></label>
                                    <input class="form-control" name="city" type="text" value="<?php echo e(@$user->address->city); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('State'); ?></label>
                                    <input class="form-control" name="state" type="text" value="<?php echo e(@$user->address->state); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Zip/Postal'); ?></label>
                                    <input class="form-control" name="zip" type="text" value="<?php echo e(@$user->address->zip); ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Country'); ?></label>
                                    <select class="form-control" name="country">
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-mobile_code="<?php echo e($country->dial_code); ?>" value="<?php echo e($key); ?>"><?php echo e(__($country->country)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xl-6 col-md-6 col-sm-3 col-12">
                                <label><?php echo app('translator')->get('Email Verification'); ?></label>
                                <input <?php if($user->ev): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-off="<?php echo app('translator')->get('Unverified'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Verified'); ?>" data-onstyle="-success" data-width="100%" name="ev" type="checkbox">

                            </div>

                            <div class="form-group col-xl-6 col-md-6 col-sm-3 col-12">
                                <label><?php echo app('translator')->get('Mobile Verification'); ?></label>
                                <input <?php if($user->sv): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-off="<?php echo app('translator')->get('Unverified'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Verified'); ?>" data-onstyle="-success" data-width="100%" name="sv" type="checkbox">

                            </div>
                        </div>

                        <?php $hasPermission = App\Models\Role::hasPermission('admin.users.update')  ? 1 : 0;
            if($hasPermission == 1): ?>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <div class="modal fade" id="userStatusModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php if($user->status == Status::USER_ACTIVE): ?>
                                <span><?php echo app('translator')->get('Ban User'); ?></span>
                            <?php else: ?>
                                <span><?php echo app('translator')->get('Unban User'); ?></span>
                            <?php endif; ?>
                        </h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.users.status', $user->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <?php if($user->status == Status::USER_ACTIVE): ?>
                                <h6 class="mb-2"><?php echo app('translator')->get('If you ban this user he/she won\'t able to access his/her dashboard.'); ?></h6>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Reason'); ?></label>
                                    <textarea class="form-control" name="reason" required rows="4"></textarea>
                                </div>
                            <?php else: ?>
                                <p><span><?php echo app('translator')->get('Ban reason was'); ?>:</span></p>
                                <p><?php echo e($user->ban_reason); ?></p>
                                <h4 class="text-center mt-3"><?php echo app('translator')->get('Are you sure to unban this user?'); ?></h4>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <?php if($user->status == Status::USER_ACTIVE): ?>
                                <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                            <?php else: ?>
                                <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('No'); ?></button>
                                <button class="btn btn--primary" type="submit"><?php echo app('translator')->get('Yes'); ?></button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict"

            let mobileElement = $('.mobile-code');
            $('select[name=country]').change(function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });
            $('select[name=country]').val('<?php echo e(@$user->country_code); ?>');
            let dialCode = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber = `<?php echo e($user->mobile); ?>`;
            mobileNumber = mobileNumber.replace(dialCode, '');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/users/detail.blade.php ENDPATH**/ ?>