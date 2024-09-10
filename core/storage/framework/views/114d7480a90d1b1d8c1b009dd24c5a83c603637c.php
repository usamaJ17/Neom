<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Username'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Email'); ?></th>
                                    <th><?php echo app('translator')->get('Role'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.staff.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $allStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($staff->id); ?></td>
                                        <td><?php echo e($staff->username); ?></td>
                                        <td><?php echo e($staff->name); ?></td>
                                        <td><?php echo e($staff->email); ?></td>
                                        <td>
                                            <?php if($staff->role): ?>
                                                <?php echo e($staff->role->name); ?>

                                            <?php else: ?>
                                                <?php echo app('translator')->get('Super Admin'); ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php
                                                echo $staff->statusBadge;
                                            ?>
                                        </td>
                                        <?php $hasPermission = App\Models\Role::hasPermission(['admin.staff.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <td>
                                                <div class="button--group">
                                                    <?php if($staff->id > 1): ?>
                                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                            <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Update Guest'); ?>" data-resource="<?php echo e($staff); ?>" type="button">
                                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                            </button>
                                                        <?php endif ?>
                                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                            <?php if($staff->status): ?>
                                                                <button class="btn btn-sm confirmationBtn btn-outline--danger" data-action="<?php echo e(route('admin.staff.status', $staff->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to ban this staff?'); ?>" type="button">
                                                                    <i class="las la-user-alt-slash"></i><?php echo app('translator')->get('Ban'); ?>
                                                                </button>
                                                            <?php else: ?>
                                                                <button class="btn btn-sm confirmationBtn btn-outline--success" data-action="<?php echo e(route('admin.staff.status', $staff->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to unban this staff?'); ?>" type="button">
                                                                    <i class="las la-user-check"></i><?php echo app('translator')->get('Unban'); ?>
                                                                </button>
                                                            <?php endif; ?>
                                                        <?php endif ?>
                                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.login')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                            <a class="btn btn-sm btn-outline--dark" href="<?php echo e(route('admin.staff.login', $staff->id)); ?>" target="_blank">
                                                                <i class="las la-sign-in-alt"></i><?php echo app('translator')->get('Login'); ?>
                                                            </a>
                                                        <?php endif ?>
                                                    <?php endif; ?>
                                                </div>
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

    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <!-- Create Update Modal -->
        <div class="modal fade" id="cuModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="<?php echo e(route('admin.staff.save')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">

                            <div class="form-group">
                                <label><?php echo app('translator')->get('Name'); ?></label>
                                <input class="form-control" name="name" required type="text">
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->get('Username'); ?></label>
                                <input class="form-control" name="username" required type="text">
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->get('Email'); ?></label>
                                <input class="form-control" name="email" required type="email">
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->get('Role'); ?></label>
                                <select class="form-control" name="role_id" required>
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                             <div class="form-group">
                                <label><?php echo app('translator')->get('Accommodation'); ?></label>
                                <select class="form-control" name="accommodation_id" required>
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->get('Password'); ?></label>
                                <div class="input-group">
                                    <input class="form-control" name="password" required type="text">
                                    <button class="input-group-text generatePassword" type="button"><?php echo app('translator')->get('Generate'); ?></button>
                                </div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Username']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Username']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <!-- Modal Trigger Button -->
    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Guest'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </button>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.generatePassword').on('click', function() {
                $(this).siblings('[name=password]').val(generatePassword());
            });

            $('.cuModalBtn').on('click', function() {
                let passwordField = $('#cuModal').find($('[name=password]'));
                let label = passwordField.parents('.form-group').find('label')
                if ($(this).data('resource')) {
                    passwordField.removeAttr('required');
                    label.removeClass('required')
                } else {
                    passwordField.attr('required', 'required');
                    label.addClass('required')
                }
            });

            function generatePassword(length = 12) {
                let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+<>?/";
                let password = '';

                for (var i = 0, n = charset.length; i < length; ++i) {
                    password += charset.charAt(Math.floor(Math.random() * n));
                }

                return password
            }
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/staff/index.blade.php ENDPATH**/ ?>