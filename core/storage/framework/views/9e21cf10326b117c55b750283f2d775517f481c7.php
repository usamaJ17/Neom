<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('ID'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.hotel.accommodations.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th>Action</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($item->id); ?></td>
                                        <td> <?php echo $item->name ?> </td>
                                        <td> <?php echo $item->statusBadge ?> </td>
                                       <td>
                                            <div class="button--group">
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accommodations.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="<?php echo app('translator')->get('Update Accommodation'); ?>" data-resource="<?php echo e($item); ?>" type="button">
                                                        <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </button>
                                                <?php endif ?>
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accommodations.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <?php if($item->status == Status::DISABLE): ?>
                                                        <button class="btn btn-sm btn-outline--success me-1 confirmationBtn" data-action="<?php echo e(route('admin.hotel.accommodations.status', $item->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this accommodation?'); ?>" type="button">
                                                            <i class="la la-eye"></i> <?php echo app('translator')->get('Enable'); ?>
                                                        </button>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.hotel.accommodations.status', $item->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this accommodation?'); ?>" type="button">
                                                            <i class="la la-eye-slash"></i> <?php echo app('translator')->get('Disable'); ?>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif ?>
                                            </div>
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

  





 <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accommodations.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo app('translator')->get('Add Accommodation'); ?></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.hotel.accommodations.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Accommodation Name'); ?></label>
                                <input class="form-control" name="name" required type="text" value="<?php echo e(old('name')); ?>">
                            </div>
                            
                          
                            
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accommodations.status')  ? 1 : 0;
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
<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accommodations.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Accommodations'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New '); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php endif ?>






<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/accommodations.blade.php ENDPATH**/ ?>