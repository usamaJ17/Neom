<?php
$bannerCon = getContent('banner.content', true);
?>
<?php if(!request()->routeIs('home')): ?>
    <section class="inner-hero bg_img" style="background-image: url('<?php echo e(getImage('assets/images/frontend/banner/' . (isset($bannerCon->data_values->breadcrumb_image) ? $bannerCon->data_values->breadcrumb_image : '' ), '')); ?>');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2 class="title text-white"><?php echo e(__($pageTitle)); ?></h2>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/templates/basic/partials/breadcrumb.blade.php ENDPATH**/ ?>