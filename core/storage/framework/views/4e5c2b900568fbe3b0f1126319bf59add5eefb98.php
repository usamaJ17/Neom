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
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Accommodation'); ?></th>
                                    <th><?php echo app('translator')->get('Email'); ?> - <?php echo app('translator')->get('Phone'); ?></th>
                                    <th><?php echo app('translator')->get('Country'); ?></th>
                                    <th><?php echo app('translator')->get('Joined At'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($user->id); ?>

                                        </td>
                                        <td>
                                            <span class="fw-bold"><?php echo e($user->fullname); ?></span>
                                            <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <br>
                                                <span class="small">
                                                    <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><span>@</span><?php echo e($user->username); ?></a>
                                                </span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php echo e($user->accommodation?->name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($user->email); ?><br> +<?php echo e($user->mobile); ?>

                                        </td>
                                        <td>
                                            <span class="fw-bold" title="<?php echo e(@$user->address->country); ?>"><?php echo e($user->country_code); ?></span>
                                        </td>
                                        <td>
                                            <?php echo e(showDateTime($user->created_at)); ?> <br> <?php echo e(diffForHumans($user->created_at)); ?>

                                        </td>
                                            <td>
                                                 <!--<?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.save')  ? 1 : 0;
            if($hasPermission == 1): ?>-->
                                                <!--<button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Update User'); ?>" data-resource="<?php echo e($user); ?>" type="button">-->
                                                <!--    <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>-->
                                               
                                                <!--</button>-->
                                            <!--<?php endif ?>-->
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.users.detail', $user->id)); ?>">
                                                    <i class="las la-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                                </a>
                                        <?php endif ?>
                                            </td>
                                    </tr>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
               
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Username / Email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Username / Email']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/users/list.blade.php ENDPATH**/ ?>