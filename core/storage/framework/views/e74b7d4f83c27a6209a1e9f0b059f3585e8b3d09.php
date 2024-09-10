<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($general->siteName($pageTitle ?? '')); ?></title>

    <link rel="shortcut icon" type="image/png" href="<?php echo e(getImage(getFilePath('logoIcon') . '/favicon.png')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('assets/global/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/bootstrap-toggle.min.css')); ?>">
    <link href="<?php echo e(asset('assets/global/css/all.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css">
    <style>
  
    .dt-buttons .buttons-excel, .dt-buttons .buttons-pdf {
        background-color: royalblue;
       
    }
    .dt-buttons span{
         color: #fff;
    }
      thead th span {
        color: #fff;
    }
</style>
    



    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/jquery-jvectormap-2.0.5.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">

    <?php echo $__env->yieldPushContent('style'); ?>
  
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>

    <script src="<?php echo e(asset('assets/global/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/bootstrap-toggle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/jquery.slimscroll.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>

    

    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('script-lib'); ?>

    <script src="<?php echo e(asset('assets/admin/js/nicEdit.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/admin/js/vendor/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/cu-modal.js')); ?>"></script>

    
    <script>
        "use strict";

        bkLib.onDomLoaded(function() {
            $(".nicEdit").each(function(index) {
                $(this).attr("id", "nicEditor" + index);
                new nicEditor({
                    fullPanel: true
                }).panelInstance('nicEditor' + index, {
                    hasPanel: true
                });
            });
        });

        (function($) {
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });
        })(jQuery);
    </script>
    
    <script>
  $(document).ready(function() {
      new DataTable('#datatable', {
          layout: {
              topStart: {
                  buttons: ['excel', 'pdf']
              }
          }
      });
} );



 </script>

    <?php echo $__env->yieldPushContent('script'); ?>
    
  
</body>

</html>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>