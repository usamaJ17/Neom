<?php $__env->startSection('style'); ?>
    <style>
        p, li, span
        {
            color: #ffffff !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('panel'); ?>

                        <table class="table" id="beds">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Accommodation Name'); ?></th>
                                    <th><?php echo app('translator')->get('Vacant Beds'); ?></th>
                                    <th><?php echo app('translator')->get('Occupied Beds'); ?></th>
                                    <th><?php echo app('translator')->get('Total Beds'); ?></th>
                                </tr>
                            </thead>
                             <?php if(isset($bed_reports)): ?>
                                <tbody>
                                    <?php
                                        $total_vacant   = 0;
                                        $total_occupied = 0;
                                        $grand_total    = 0;
                                    ?>
                                <?php $__currentLoopData = $bed_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
                                    <?php
                                        $vacant         = $bed['total_beds'] - $bed['occupied_beds'];
                                        $total_vacant   += $vacant;
                                        $total_occupied += $bed['occupied_beds'];
                                        $grand_total    += $bed['total_beds']
                                    ?>
                                <tr>
                                    <td><?php echo e($bed['accommodation']); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $bed['bed_types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge--success">Bed Type <?php echo e($type->name); ?> : <?php echo e($bed['beds']->where('bed_type_id',$type->id)->count() - $bed['occupieds']->where('bed_type_id',$type->id)->count()); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge--success">Total : <?php echo e($bed['total_beds'] - $bed['occupied_beds']); ?></span>
                                    </td>
                                    <td>
                                        <?php $__currentLoopData = $bed['bed_types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge--success">Bed Type <?php echo e($type->name); ?> : <?php echo e($bed['occupieds']->where('bed_type_id',$type->id)->count()); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge--success">Total : <?php echo e($bed['occupied_beds']); ?></span>
                                    </td>
                                    <td><?php echo e($bed['total_beds']); ?></td>
                                   </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <th>Grand Total</th>
                                <th><?php echo e($total_vacant); ?></th>
                                <th><?php echo e($total_occupied); ?></th>
                                <th><?php echo e($grand_total); ?></th>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
  $(document).ready(function() {
      new DataTable('#beds', {
          layout: {
              topStart: {
                  buttons: ['excel', 'pdf']
              }
          }
      });
} );
 </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/reports/bed_count_report.blade.php ENDPATH**/ ?>