<?php $__env->startSection('layout'); ?>

    <?php if(!request()->routeIs('user.login') && !request()->routeIs('user.register')): ?>        
        <?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <main class="main-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/templates/basic/layouts/frontend.blade.php ENDPATH**/ ?>