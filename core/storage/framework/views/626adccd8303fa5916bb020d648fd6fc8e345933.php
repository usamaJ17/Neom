<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Booking No.'); ?></th>
                                    <th><?php echo app('translator')->get('Details'); ?></th>
                                    <th><?php echo app('translator')->get('Action By'); ?></th>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookingLog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(can('admin.booking.all') ? route('admin.booking.all', ['search' => @$log->booking->booking_number]) : 'javascript:void(0)'); ?>" class="fw-bold">#<?php echo e(@$log->booking->booking_number); ?></a>
                                        </td>

                                        <td>
                                            <?php if($log->details): ?>
                                                <?php echo e(__($log->details)); ?>

                                            <?php else: ?>
                                                <?php echo e(__(keyToTitle($log->remark))); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo e(__(@$log->admin->name)); ?>

                                        </td>
                                        <td>
                                            <?php echo e(showDateTime($log->created_at)); ?> <br>
                                            <?php echo e(diffForHumans($log->created_at)); ?>

                                        </td>
                                    </tr>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
               
            </div><!-- card end -->
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="" method="GET" class="form-search">
        <select name="remark" class="form-control">
            <option value=""><?php echo app('translator')->get('All Remark'); ?></option>
            <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($remark->remark); ?>"><?php echo e(__(keyToTitle($remark->remark))); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Booking No.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Booking No.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";

        $('[name=remark]').on('change', function() {
            $('.form-search').submit();
        })

        <?php if(request()->remark): ?>
            let remark = <?php echo json_encode(request()->remark, 15, 512) ?>;
            $(`[name=remark] option[value="${remark}"]`).prop('selected', true);
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/reports/booking_actions.blade.php ENDPATH**/ ?>