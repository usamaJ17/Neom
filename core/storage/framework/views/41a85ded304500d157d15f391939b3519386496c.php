<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body ">
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Site Title'); ?></label>
                                    <input class="form-control" name="site_name" required type="text" value="<?php echo e($general->site_name); ?>">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Site Base Color'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0 p-0">
                                            <input class="form-control colorPicker" type='text' value="<?php echo e($general->base_color); ?>" />
                                        </span>
                                        <input class="form-control colorCode" name="base_color" type="text" value="<?php echo e($general->base_color); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Site Currency'); ?></label>
                                    <input class="form-control" name="cur_text" required type="text" value="<?php echo e($general->cur_text); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Currency Symbol'); ?></label>
                                    <input class="form-control" name="cur_sym" required type="text" value="<?php echo e($general->cur_sym); ?>">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group select2-parent">
                                    <label> <?php echo app('translator')->get('Timezone'); ?></label>
                                    <select class="select2-basic" name="timezone">
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="'<?php echo e(@$timezone); ?>'"><?php echo e(__($timezone)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Tax Name'); ?></label>
                                    <input class="form-control" name="tax_name" required type="text" value="<?php echo e($general->tax_name); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Tax Percent Charge'); ?></label>
                                    <div class="input-group">
                                        <input class="form-control" name="tax" required type="text" value="<?php echo e($general->tax); ?>">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Check In Time'); ?></label>
                                    <div class="input-group clockpicker">
                                        <input autocomplete="off" class="form-control" name="checkin_time" placeholder="--:--" required type="text" value="<?php echo e(showDateTime($general->checkin_time, 'H:i')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Checkout Time'); ?></label>
                                    <div class="input-group clockpicker">
                                        <input autocomplete="off" class="form-control" name="checkout_time" placeholder="--:--" required type="text" value="<?php echo e(showDateTime($general->checkout_time, 'H:i')); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Upcoming Check-In List'); ?> <i class="las la-info-circle" title="<?php echo app('translator')->get('The number of days of data you want to see in the upcoming checkin list.'); ?>"></i></label>
                                    <div class="input-group">
                                        <input class="form-control" name="upcoming_checkin_days" min="1" required type="numeric" value="<?php echo e($general->upcoming_checkin_days); ?>">
                                        <span class="input-group-text"><?php echo app('translator')->get('Days'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Upcoming Checkout List'); ?> <i class="las la-info-circle" title="<?php echo app('translator')->get('The number of days of data you want to see in the upcoming checkout list.'); ?>"></i></label>
                                    <div class="input-group">
                                        <input class="form-control" name="upcoming_checkout_days" min="1" required type="numeric" value="<?php echo e($general->upcoming_checkout_days); ?>">
                                        <span class="input-group-text"><?php echo app('translator')->get('Days'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/spectrum.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/bootstrap-clockpicker.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/spectrum.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/admin/css/vendor/bootstrap-clockpicker.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .select2-parent {
            position: relative;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'<?php echo e(config('app.timezone')); ?>'").select2();
            $('.select2-basic').select2({
                dropdownParent: $('.select2-parent')
            });

            // clock picker
            $('.clockpicker').clockpicker({
                placement: 'bottom',
                align: 'left',
                donetext: 'Done',
                autoclose: true,
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/setting/general.blade.php ENDPATH**/ ?>