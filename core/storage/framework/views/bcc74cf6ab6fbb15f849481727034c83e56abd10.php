<?php $__env->startSection('panel'); ?>
    <?php $due = $booking->due() ?>
    <div class="row gy-4">
        <?php if($due > 0): ?>
            <div class="col-md-12">
                <div class="custom-badge custom-badge--danger">
                    <?php echo app('translator')->get('The guest didn\'t pay the due payment for this booking yet. The checkout process can\'t be completed until the payment is settled. Please receive the due amount.'); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if($due < 0): ?>
            <div class="col-md-12">
                <div class="custom-badge custom-badge--danger">
                    <?php echo app('translator')->get('The guest didn\'t receive the refundable amount for this booking yet. The checkout process can\'t be completed until the payment is settled. Please refund the amount.'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-6">
            <div class="row gy-4">
                <div class="col-12">
                    <?php echo $__env->make('admin.booking.partials.guest_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>



            </div>
        </div>
        <div class="col-md-6">
            <div class="row gy-4">



                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 d-flex flex-wrap justify-content-between align-items-center">
                                <span>
                                    <?php echo app('translator')->get('Booking Number'); ?>: <span class="fw-500">#<?php echo e($booking->booking_number); ?></span>
                                </span>
                                <?php
                                    echo $booking->status_badge;
                                    
                                ?>
                            </div>
                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.booking.invoice', 'admin.booking.checkout', 'admin.booking.payment'])  ? 1 : 0;
            if($hasPermission == 1): ?>








                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.checkout')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <form action="<?php echo e(route('admin.booking.checkout', $booking->id)); ?>" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Upload Signature'); ?></label>
                                    <input type="file" class="form-control" name="sign" id="sign" required>
                                </div>
                                        
                                        <button class="btn btn-lg btn--dark flex-grow-1"><i class="las la-sign-out-alt"></i><?php echo app('translator')->get('Check Out'); ?></button>
                                    </form>
                                    <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.checkout')  ? 1 : 0;
            if($hasPermission == 1): ?>
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
    <?php endif ?>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.booking.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.booking.all')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.booking.all')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php $__env->startPush('style'); ?>
    <style>
        .total {
            color: unset;
        }

        .custom-badge--danger {
            border-left-color: #ea5455 !important;
            color: #ea5455 !important;
        }

        .custom-badge {
            padding: 1.25rem;
            border: 1px solid #e9ecef;
            border-left-width: 0.25rem;
            border-radius: 5px;
            background: #fff;
        }

        .list .list-item {
            border: 1px solid #f1f1f1;
            border-bottom: 0;
            display: flex;
            justify-content: space-between;
            padding: 0.6rem;
        }

        .list .list-item span:first-child {
            font-weight: 500;
            border-radius: 7px 7px 0 0;
        }

        .list .list-item:first-child {
            border-radius: 7px 7px 0 0;
        }

        .list .list-item:last-child {
            border-bottom: 1px solid #f1f1f1;
            border-radius: 0 0 7px 7px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/booking/check_out.blade.php ENDPATH**/ ?>