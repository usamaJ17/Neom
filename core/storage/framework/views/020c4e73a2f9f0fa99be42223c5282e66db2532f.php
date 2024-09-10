<?php
    $bannerContent = getContent('banner.content', true);
    $userDate = session()->get('users_date');
?>

<section class="hero-section bg_img" style="background-image: url('<?php echo e(getImage('assets/images/frontend/banner/' . $bannerContent->data_values->banner_image, '1800x800')); ?>');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xxl-7">
                <h2 class="hero-section__title text-center"><?php echo e(__(@$bannerContent->data_values->heading)); ?></h2>
            </div>
            <div class="col-lg-12 mt-5">
                <form action="<?php echo e(route('room.type.filter')); ?>" autocomplete="off" method="get">
                    <div class="filter-wrapper">
                        <div class="row g-xxl-4 g-3">
                            <input name="banner_form" type="hidden" value="1">
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <div class="custom-icon-field">
                                    <input class="checkin-checkout-date form--control" data-language="en" data-multiple-dates-separator=" - " data-position='top left' data-range="true" name="date" placeholder="<?php echo app('translator')->get('Check In - Check Out'); ?>" type="text">
                                    <i class="las la-calendar-alt"></i>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <div class="custom-icon-field">
                                    <input class="form--control" min="0" name="total_adult" placeholder="<?php echo app('translator')->get('Total Adult'); ?>" type="number" value="<?php echo e(old('total_adult')); ?>">
                                    <i class="las la-male"></i>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <div class="custom-icon-field">
                                    <input class="form--control" min="0" name="total_child" placeholder="<?php echo app('translator')->get('Total Child'); ?>" type="number" value="<?php echo e(old('total_child')); ?>">
                                    <i class="las la-child"></i>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <button class="btn fs--14px btn--base w-100 px-2" type="submit"><?php echo app('translator')->get('CHECK AVAILABILITY'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/global/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            var datepicker = $('.checkin-checkout-date').datepicker({
                autoClose: true,
                multipleDates: true,
                autoClose: true
            });

            <?php if(isset($userDate)): ?>
                var minDate = <?php echo json_encode($userDate['checkin'], 15, 512) ?>;
                var maxDate = <?php echo json_encode($userDate['check_out'], 15, 512) ?>;
                datepicker.data('datepicker').selectDate([new Date(minDate), new Date(maxDate)]);
            <?php endif; ?>

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/templates/basic/sections/banner.blade.php ENDPATH**/ ?>