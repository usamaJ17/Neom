<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Rooms'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Adult'); ?></th>
                                    <th><?php echo app('translator')->get('Feature Status'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.hotel.room.type.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $typeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($type->name); ?></td>
                                        <td><?php echo e($type->rooms_count); ?></td>
                                        <td><?php echo e($type->accommodation->name); ?></td>
                                        <td><?php echo e($type->total_adult); ?></td>
                                        <td><?php echo $type->featureBadge  ?></td>

                                        <td><?php echo $type->statusBadge  ?></td>
                                        <?php $hasPermission = App\Models\Role::hasPermission(['admin.hotel.room.type.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <td>
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.type.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.hotel.room.type.edit', $type->id)); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </a>
                                                <?php endif ?>
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.type.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <?php if($type->status == 0): ?>
                                                        <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.type.status', $type->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this room type?'); ?>">
                                                            <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                        </button>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-action="<?php echo e(route('admin.hotel.room.type.status', $type->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this room type?'); ?>">
                                                            <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif ?>
                                            </td>
                                        <?php endif ?>

                                    </tr>
                              
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.type.status')  ? 1 : 0;
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
<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.type.create')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.hotel.room.type.create')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/hotel/room_type/list.blade.php ENDPATH**/ ?>