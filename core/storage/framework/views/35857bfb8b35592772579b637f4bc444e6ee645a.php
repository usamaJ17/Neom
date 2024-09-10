<!-- meta tags and other links -->
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="<?php echo e(config('app.locale')); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <title> <?php echo e($general->siteName(__($pageTitle))); ?></title>
    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Bootstrap CSS -->
    <link href="<?php echo e(asset('assets/global/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/global/css/all.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>" rel="stylesheet" />

    <!-- slick slider css -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/slick.css')); ?>" rel="stylesheet">
    <!-- lightcase css -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/lightcase.css')); ?>" rel="stylesheet">
    <!-- jquery ui css -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/jquery-ui.css')); ?>" rel="stylesheet">
    <!-- datepicker css -->
    <link href="<?php echo e(asset('assets/global/css/vendor/datepicker.min.css')); ?>" rel="stylesheet">
    <!-- main css -->
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/main.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset($activeTemplateTrue . 'css/custom.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <?php echo $__env->yieldPushContent('style'); ?>

    <link href="<?php echo e(asset($activeTemplateTrue . 'css/color.php')); ?>?color=<?php echo e($general->base_color); ?>" rel="stylesheet">
</head>

<body>
    <?php echo $__env->yieldPushContent('fbComment'); ?>

    <!-- preloader start -->
    <div class="preloader">

        <img alt="<?php echo e(__($general->site_name)); ?>" class="logo__is" src="<?php echo e(getImage(getFilepath('logoIcon') . '/logo_dark.png')); ?>" />
        <!-- Logo End -->
        <div class='preloader-dotline'>
            <div class='dot'></div>
            <div class='dot'></div>
            <div class='dot'></div>
            <div class='dot'></div>
            <div class='dot'></div>
            <div class='dot'></div>
            <div class='dot'></div>
            <div class='dot'></div>
        </div>
    </div>
    <!-- preloader end -->

    <div class="body-overlay"></div>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" height="100%" viewBox="-1 -1 102 102" width="100%">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <?php echo $__env->yieldContent('layout'); ?>

    <!-- jQuery library -->
    <script src="<?php echo e(asset('assets/global/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- slick  slider js -->
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/slick.min.js')); ?>"></script>
    <!-- wow js  -->
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/wow.min.js')); ?>"></script>

    <!-- lightcase js -->
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/lightcase.js')); ?>"></script>

    <!-- jquery ui js -->
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/jquery-ui.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script-lib'); ?>
    <!-- main js -->
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/app.js')); ?>"></script>

    <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('script'); ?>

    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "<?php echo e(route('home')); ?>/change/" + $(this).val();
            });

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                matched = event.matches;
                if (matched) {
                    $('body').addClass('dark-mode');
                    $('.navbar').addClass('navbar-dark');
                } else {
                    $('body').removeClass('dark-mode');
                    $('.navbar').removeClass('navbar-dark');
                }
            });

            let matched = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (matched) {
                $('body').addClass('dark-mode');
                $('.navbar').addClass('navbar-dark');
            } else {
                $('body').removeClass('dark-mode');
                $('.navbar').removeClass('navbar-dark');
            }

            var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });


            $('.policy').on('click', function() {
                $.get('<?php echo e(route('cookie.accept')); ?>', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }

            });

        })(jQuery);
    </script>
</body>

</html>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/templates/basic/layouts/app.blade.php ENDPATH**/ ?>