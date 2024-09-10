<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Subject'); ?></th>
                                    <th><?php echo app('translator')->get('Submitted By'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Priority'); ?></th>
                                    <th><?php echo app('translator')->get('Last Reply'); ?></th>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.view')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.view')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <a class="fw-bold" href="<?php echo e(route('admin.ticket.view', $item->id)); ?>"> [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($item->ticket); ?>] <?php echo e(strLimit($item->subject, 30)); ?> </a>
                                            <?php else: ?>
                                                <span class="fw-bold"> [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($item->ticket); ?>] <?php echo e(strLimit($item->subject, 30)); ?> </span>
                                            <?php endif ?>
                                        </td>

                                        <td>
                                            <?php if($item->user_id): ?>
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <a href="<?php echo e(route('admin.users.detail', $item->user_id)); ?>"> <?php echo e(__($item->user->fullname)); ?></a>
                                                <?php else: ?>
                                                    <p class="fw-bold"><?php echo e(__($item->user->fullname)); ?></p>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <p class="fw-bold"> <?php echo e($item->name); ?></p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $item->statusBadge; ?>
                                        </td>
                                        <td>
                                            <?php if($item->priority == Status::PRIORITY_LOW): ?>
                                                <span class="badge badge--dark"><?php echo app('translator')->get('Low'); ?></span>
                                            <?php elseif($item->priority == Status::PRIORITY_MEDIUM): ?>
                                                <span class="badge  badge--warning"><?php echo app('translator')->get('Medium'); ?></span>
                                            <?php elseif($item->priority == Status::PRIORITY_HIGH): ?>
                                                <span class="badge badge--danger"><?php echo app('translator')->get('High'); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo e(diffForHumans($item->last_reply)); ?>

                                        </td>
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.view')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <td>
                                                <a class="btn btn-sm btn-outline--primary ms-1" href="<?php echo e(route('admin.ticket.view', $item->id)); ?>">
                                                    <i class="las la-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                                </a>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
               
            </div><!-- card end -->
        </div>
    </div>
    
     <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
        
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo app('translator')->get('Add Ticket'); ?></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.ticket.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Subject'); ?></label>
                                <input class="form-control" name="subject" required type="text" value="<?php echo e(old('subject')); ?>">
                            </div>
                            
                          
                            
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label> <?php echo app('translator')->get('Message'); ?></label>
                                <input class="form-control" name="message" required type="text" value="<?php echo e(old('message')); ?>">
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

<?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add Ticket'); ?>" type="button">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add New '); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/support/tickets.blade.php ENDPATH**/ ?>