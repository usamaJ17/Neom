<?php $__env->startSection('panel'); ?>
    <div class="row">
         <div class="d-flex mb-3 gap-2">
            <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.foundby')); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Found By'); ?> </a>
            <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.handedOverBy')); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Handed Over By'); ?> </a>
            <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.handedOverto')); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Handed Over To'); ?> </a>
        </div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('SL'); ?></th>
                                    <th><?php echo app('translator')->get('Location'); ?></th>
                                    <th><?php echo app('translator')->get('Brand '); ?></th>
                                    <th><?php echo app('translator')->get('Colour '); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>

                                        <td><?php echo e($row->location); ?></td>
                                        
                                        <td><?php echo e($row->brand); ?></td>
                                        <td><?php echo e($row->colour); ?></td>
                                      
                                            <td>
                                               
                                                <a target="_blank" class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.lostFounditemreport',$row->id)); ?>"> <i class="la la-list"></i><?php echo app('translator')->get('Report'); ?>
                                                </a>
                                                
                                                <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.lostFounditemedit',$row->id)); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                                <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.lostFounditemdelete',$row->id)); ?>" data-question="Are you sure, you want to delete this bed?">
                                                <i class="la la-trash"></i>Delete</a>
                                            </td>
                                       

                                    </tr>
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              
                              

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="d-flex mb-30 flex-wrap gap-3 justify-content-between align-items-center mt-5">
    <h6 class="page-title">Founded By</h6>
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plugins">
        <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.foundbycreate')); ?>"><i class="las la-plus"></i>Add Found By</a>
        </div>
</div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable2">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Sl'); ?></th>
                                    <th><?php echo app('translator')->get('Guest ID '); ?></th>
                                    <th><?php echo app('translator')->get('Time Found '); ?></th>
                                    <th><?php echo app('translator')->get('Date Found '); ?></th>
                                   
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                  <?php $__currentLoopData = $foundby; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->user?->firstname); ?> <?php echo e($item->user?->lastname); ?> (<?php echo e($item->user?->id); ?>)</td>

                                        <td><?php echo e($item->colour); ?></td>
                                        
                                        <td><?php echo e($item->date); ?></td>
                                      
                                            <td>
                                               
                                                    <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.foundbyedit',$item->id)); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </a>
                                                       <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.foundbydelete',$item->id)); ?>" data-question="Are you sure, you want to delete this bed?">
                                                          <i class="la la-trash"></i>Delete</a>
                                                   
                                               
                                            </td>
                                       

                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              
                              

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
        
        <div class="d-flex mb-30 flex-wrap gap-3 justify-content-between align-items-center mt-5">
    <h6 class="page-title">Handed Over By</h6>
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plugins">
                <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.handedOverBycreate')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add Handed Over By'); ?></a>
        </div>
</div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable3">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Sl'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Guest ID '); ?></th>
                                    <th><?php echo app('translator')->get('Designation'); ?></th>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $__currentLoopData = $handedby; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->name); ?></td>

                                        <td><?php echo e($item->user?->firstname); ?> <?php echo e($item->user?->lastname); ?> (<?php echo e($item->user?->id); ?>)</td>
                                        
                                        <td><?php echo e($item->designation); ?></td>
                                      
                                            <td>
                                               
                                                    <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.handedOverByedit',$item->id)); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </a>
                                                      <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.handedOverBydelete',$item->id)); ?>" data-question="Are you sure, you want to delete this bed?">
                                                          <i class="la la-trash"></i>Delete</a>
                                                   
                                               
                                            </td>
                                       

                                    </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
        
        <div class="d-flex mb-30 flex-wrap gap-3 justify-content-between align-items-center mt-5">
    <h6 class="page-title">Handed Over To</h6>
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plugins">
        <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.handedOvetocreate')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add Handed Over To'); ?></a>
        </div>
</div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable4">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Sl'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Mobile Number '); ?></th>
                                    <th><?php echo app('translator')->get('Designation'); ?></th>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php $__currentLoopData = $handedto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->name); ?></td>

                                        <td><?php echo e($item->number); ?></td>
                                        
                                        <td><?php echo e($item->designation); ?></td>
                                      
                                            <td>
                                               
                                                  
                                                     <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.handedOvertoedit',$item->id)); ?>"> <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                    </a>
                                                        <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="<?php echo e(route('admin.handedOvertodelete',$item->id)); ?>" data-question="Are you sure, you want to delete this bed?">
                                                          <i class="la la-trash"></i>Delete</a>
                                                   
                                               
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
<?php $__env->stopSection(); ?>
    <?php $__env->startPush('script'); ?>
        <script>
              $(document).ready(function() {
                  new DataTable('#datatable2', {
                      layout: {
                          topStart: {
                              buttons: ['excel', 'pdf']
                          }
                      }
                  });
                  new DataTable('#datatable3', {
                      layout: {
                          topStart: {
                              buttons: ['excel', 'pdf']
                          }
                      }
                  });
                  new DataTable('#datatable4', {
                      layout: {
                          topStart: {
                              buttons: ['excel', 'pdf']
                          }
                      }
                  });
            } );
 </script>
     <script>
        (function($) {
            "use strict";
            $(document).on('click', '.confirmationBtn', function() {
                var modal = $('#confirmationModal');
                let data = $(this).data();
                modal.find('.question').text(`${data.question}`);
                modal.find('form').attr('action', `${data.action}`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
  

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.lostFounditemcreate')); ?>"><i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
    <?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/lostFounditem/index.blade.php ENDPATH**/ ?>