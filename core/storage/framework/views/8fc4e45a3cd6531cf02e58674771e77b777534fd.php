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
                                    <th><?php echo app('translator')->get('Staff Name'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Transfer By'); ?></th>
                                    <th><?php echo app('translator')->get('Transfer Date'); ?></th>
                                  
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $transferStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($staff->id); ?></td>
                                        <td><?php echo e($staff->user->firstname); ?></td>
                                        <td><?php echo e($staff->accommodation->name); ?></td>
                                        <td><?php echo e($staff->admin->name); ?></td>
                                        <td><?php echo e($staff->transfer_date); ?></td>
                                       
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

                    <form action="<?php echo e(route('admin.staff.transferSave')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">

                             <div class="form-group">
                                <label><?php echo app('translator')->get('Guest'); ?></label>
                                <select class="form-control" name="staff_id" required>
                                    <option disabled selected value=""><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $allStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->firstname); ?> <?php echo e($staff->lastname); ?></option>
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
                                <label><?php echo app('translator')->get('Transfer Date'); ?></label>
                                <input class="form-control" name="transfer_date" required type="date">
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

    <!-- Modal Trigger Button -->
    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.transferSave')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Guest'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </button>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/staff/trasnferStaff.blade.php ENDPATH**/ ?>