<?php $__env->startSection('panel'); ?>
    <?php if(@json_decode($general->system_info)->version > systemDetails()['version']): ?>
        
    <?php endif; ?>
    <?php if(@json_decode($general->system_info)->message): ?>
        <div class="row">
            <?php $__currentLoopData = json_decode($general->system_info)->message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                    <div class="alert border--primary border" role="alert">
                        <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                        <p class="alert__message"><?php echo $msg; ?></p>
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    
      <div class="row clearfix mb-4">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="change-date"><?php echo e(__('Select Date')); ?><span class="text-red">*</span></label>
                                <input name="created_at" id="change-date" type="date" class="form-control" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="align-items-center col-lg-8 col-md-8 col-sm-8 d-flex">
            <a class="btn btn--danger me-3" href="<?php echo e(route('admin.users.transfer')); ?>">
                    <?php echo app('translator')->get('Transfer Guest'); ?>
                </a>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.request.booking.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <a class="btn btn--danger me-3" href="<?php echo e(url('admin/booking/pending/check-in')); ?>">
                    <?php echo app('translator')->get('Check In'); ?>
                </a>
                <a class="btn btn--danger me-3" href="<?php echo e(url('admin/book-room')); ?>">
                    <?php echo app('translator')->get('Book A Room'); ?>
                </a>
                <a class="btn btn--danger me-3" href="<?php echo e(route('admin.request.booking.all')); ?>">
                    <?php echo app('translator')->get('Booking Requests'); ?> <small class="fw-bold px-2 rounded bg-light text--danger"><?php echo e($bookingRequestCount); ?></small>
                </a>
            <?php endif ?>
        </div>
        </div>
        <div class="row">
            
             <!-- Total Daily Checkin-->
        <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                           <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($dailyCheckins)): ?>
                                <h3 class="mb-0" id="beds"><?php echo e($dailyCheckins); ?></h3>
                            <?php endif; ?>
                             <p> Daily Checkin</p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        
        
         <!-- Total Daily Checkout-->
        <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($dailyCheckouts)): ?>
                                <h3 class="mb-0" id="beds"><?php echo e($dailyCheckouts); ?></h3>
                            <?php endif; ?>
                             <p>Daily Checkout</p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        
        
           <!-- Total Monthly Checkin-->
             <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                           <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($monthlyCheckins)): ?>
                                <h3 class="mb-0" id="beds"><?php echo e($monthlyCheckins); ?></h3>
                            <?php endif; ?>
                             <p><?php echo e($currentMonth. " Total Checkin"); ?></p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        
        
         <!-- Total Monthly Checkout-->
        <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($monthlyCheckouts)): ?>
                                <h3 class="mb-0" id="beds"><?php echo e($monthlyCheckouts); ?></h3>
                            <?php endif; ?>
                             <p><?php echo e($currentMonth. " Total Checkout"); ?></p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row gy-4">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Room Type</h5>
                </div>
            </div>
        </div>
      
          <div class="row" id="roomTypesContainer">
            <?php $__currentLoopData = $roomTypesWithCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xxl-3 col-sm-6 position-relative gy-3">
                 <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="widget-two__icon b-radius--5 border border--primary bg-primary">
                                <i class="la la-city icon-color-efs"></i>
                            </div>
                            <div class="widget-two__content">
                                <h6 class="mb-0"><?php echo e($roomType->name); ?> - <?php echo e($roomType->accommodation->name); ?></h6>
                                <p>Room Count: <?php echo e($roomType->rooms_count); ?></p>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo e(url('admin/hotel/bed-list?roomType=' . $roomType->id . '&accommodation=' . $roomType->accommodation->id)); ?>" class="widget-two__btn btn btn-outline--primary" style="cursor: pointer">View All</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> 
        <hr>

    <div class="row gy-4">
        
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['bg' => 'primary','icon' => 'las la-users f-size--56','link' => 'admin.users.all','title' => 'Total Registered Guests','value' => ''.e($widget['total_users']).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bg' => 'primary','icon' => 'las la-users f-size--56','link' => 'admin.users.all','title' => 'Total Registered Guests','value' => ''.e($widget['total_users']).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['bg' => 'success','icon' => 'las la-user-check f-size--56','link' => 'admin.users.active','title' => 'Active Registered Guests','value' => ''.e($widget['verified_users']).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bg' => 'success','icon' => 'las la-user-check f-size--56','link' => 'admin.users.active','title' => 'Active Registered Guests','value' => ''.e($widget['verified_users']).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div>
        
         
        <!-- Bed Total-->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-hospital-alt icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['rooms'])): ?>
                                <h3 class="mb-0" id="beds"><?php echo e($widget['rooms']); ?></h3>
                            <?php endif; ?>
                             <p>Total Rooms</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.hotel.bed.all')); ?>" class="widget-two__btn btn btn-outline--success" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
             <!-- Room Total-->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-bed icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['beds'])): ?>
                                <h3 class="mb-0" id="rooms"><?php echo e($widget['beds']); ?></h3>
                            <?php endif; ?>
                             <p>Total Beds</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.hotel.room.all')); ?>" class="widget-two__btn btn btn-outline--success" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
                
                        <!-- Total Bookings -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['total'])): ?>
                                <h3 class="mb-0" id="total"><?php echo e($widget['total']); ?></h3>
                            <?php endif; ?>
                             <p>Total Bookings</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.booking.all')); ?>" class="widget-two__btn btn btn-outline--primary" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        
                <!-- Active Booking -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success bg-success">
                            <i class="la la-clipboard-check icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['active'])): ?>
                                <h3 class="mb-0" id="active"><?php echo e($widget['active']); ?></h3>
                            <?php endif; ?>
                             <p>Active Booking</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.booking.active')); ?>" class="widget-two__btn btn btn-outline--success" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
       
        

        
        
        
        <!-- delayed_checkout -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--danger text--danger">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['delayed_checkout'])): ?>
                                <h3 class="mb-0" id="delayed_checkout"><?php echo e($widget['delayed_checkout']); ?></h3>
                            <?php endif; ?>
                             <p>Delayed Checkout</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.delayed.booking.checkout')); ?>" class="widget-two__btn btn btn-outline--danger" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>

      
      
       <!-- Pending Check-In -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--warning text--warning">
                            <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['pending_checkin'])): ?>
                                <h3 class="mb-0" id="pending_checkin"><?php echo e($widget['pending_checkin']); ?></h3>
                            <?php endif; ?>
                             <p>Pending Check-In</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.pending.booking.checkin')); ?>" class="widget-two__btn btn btn-outline--warning" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
               <!-- Upcoming Check-In -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info text--info">
                            <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['upcoming_checkin'])): ?>
                                <h3 class="mb-0" id="upcoming_checkin"><?php echo e($widget['upcoming_checkin']); ?></h3>
                            <?php endif; ?>
                             <p>Upcoming Check-In</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.upcoming.booking.checkin')); ?>" class="widget-two__btn btn btn-outline--info" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        
        <!-- Upcoming Checkout -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info text--info">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['upcoming_checkout'])): ?>
                                <h3 class="mb-0" id="upcoming_checkout"><?php echo e($widget['upcoming_checkout']); ?></h3>
                            <?php endif; ?>
                             <p>Upcoming Checkout</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.upcoming.booking.checkout')); ?>" class="widget-two__btn btn btn-outline--info" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
       
        
     
     
        
        
                <!-- Today's Booked Rooms -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--dark bg-dark">
                            <i class="la la-check-circle icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['today_booked'])): ?>
                                <h3 class="mb-0" id="today_booked"><?php echo e($widget['today_booked']); ?></h3>
                            <?php endif; ?>
                             <p>Occupied Beds</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.hotel.room.getOccupiedRoom')); ?>" class="widget-two__btn btn btn-outline--dark" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        <!-- Today's Available Rooms -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info bg-info">
                            <i class="la la-hospital-alt icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['today_available'])): ?>
                                <h3 class="mb-0" id="today_available"><?php echo e($widget['today_available']); ?></h3>
                            <?php endif; ?>
                             <p>Vacant Beds</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.hotel.room.getVacantRoom')); ?>" class="widget-two__btn btn btn-outline--info" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        <!-- Today's Available Rooms -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info bg-info">
                            <i class="la la-hospital-alt icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['vacant_rooms'])): ?>
                                <h3 class="mb-0" id="vacant_rooms"><?php echo e($widget['vacant_rooms']); ?></h3>
                            <?php endif; ?>
                             <p>Vacant Rooms</p>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        
         <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--danger text--danger">
                            <i class="fas fa-hotel icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            <?php if(isset($widget['amenities'])): ?>
                                <h3 class="mb-0" id="amenities"><?php echo e($widget['amenities']); ?></h3>
                            <?php endif; ?>
                             <p>Amenity</p>
                        </div>
                    </div>
            
                    <a href="<?php echo e(route('admin.hotel.amenity.all')); ?>" class="widget-two__btn btn btn-outline--danger" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        

        

        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Guests by Accommodation</h5>
                </div>
            </div>
        </div>
        <div class="row gy-2" id="accommodation_type_container">
        <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-users icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="mb-0"><?php echo e($row->guests->count()); ?> Guests</h3>
                             <p><?php echo e($row->name); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        </div>
            
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Bed Type</h5>
                </div>
            </div>
        </div>
        <div class="row gy-4" id="bed_type_container">
            <?php
        $total_type = 0;
        ?>
        <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $total_type += $type->newBedTypes->count();
        ?>
        <?php if(!auth()->guard('admin')->user()->accommodation_id): ?>
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total"><?php echo e($type->newBedTypes->count()); ?></h3>
                             <p><?php echo e($type->name); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <?php $__currentLoopData = $type->newBedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bedtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="mb-0"><?php echo e($bedtype->beds->count()); ?> Beds</h3>
                             <p>Bed Type <?php echo e($bedtype->name); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total"><?php echo e($total_type); ?></h3>
                             <p>Total Bed Type</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Bed Key</h5>
                </div>
            </div>
        </div>
        <?php
        $total_key = 0;
        ?>
        <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $keys = \App\Models\RoomKey::whereHas('bed',function($q) use($type) {
            $q->where('accommodation_id',$type->id);
        })->count();
        $total_key += $keys;
        ?>
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total"><?php echo e($keys); ?></h3>
                             <p><?php echo e($type->name); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total"><?php echo e($total_key); ?></h3>
                             <p>Total Bed Key</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>




<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/chart.js.2.8.0.js')); ?>"></script>

    <script>
        "use strict";

        //last one 12 month booking graph
        var options = {
            series: [{
                name: 'Total Booking Amount',
                data: [
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(getAmount(@$bookingMonth->where('months', $month)->first()->bookingAmount)); ?>,
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            }],
            chart: {
                type: 'bar',
                height: 450,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: <?php echo json_encode($months, 15, 512) ?>,
            },
            yaxis: {
                title: {
                    text: "<?php echo e(__($general->cur_sym)); ?>",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "<?php echo e(__($general->cur_sym)); ?>" + val + " "
                    }
                }
            }
        };


        var chart = new ApexCharts(document.querySelector("#apex-bar-chart-1"), options);
        chart.render();


        // apex-line chart
        var options = {
            chart: {
                height: 450,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#28c76f', '#ea5455', '#546E7A', '#E91E63', '#FF9800'],
            series: [{
                    name: "Received",
                    data: [
                        <?php $__currentLoopData = $trxReport['date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trxDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(@$plusTrx->where('date', $trxDate)->first()->amount ?? 0); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                },
                {
                    name: "Returned",
                    data: [
                        <?php $__currentLoopData = $trxReport['date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trxDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(@$minusTrx->where('date', $trxDate)->first()->amount ?? 0); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    <?php $__currentLoopData = $trxReport['date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trxDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($trxDate); ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        chart.render();

        var ctx = document.getElementById('userBrowserChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($chart['user_browser_counter']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo e($chart['user_browser_counter']->flatten()); ?>,
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                maintainAspectRatio: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });



        var ctx = document.getElementById('userOsChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($chart['user_os_counter']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo e($chart['user_os_counter']->flatten()); ?>,
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.05)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            },
        });


        // Donut chart
        var ctx = document.getElementById('userCountryChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($chart['user_country_counter']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo e($chart['user_country_counter']->flatten()); ?>,
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
    <script>
    
    $('#change-accommodation').change(function (e)
            {
                e.preventDefault();
                var accommodation = $(this).val();
                if(!accommodation){
                    window.location.reload();
                }
                var created_at = $('#change-date').val();
                console.log('accommodation'+ accommodation);
                 $.ajax({
                    type:'POST',
                    url:"<?php echo e(route('admin.get-dashboard-data')); ?>",
                    data:{
                        accommodation:accommodation,
                        created_at:created_at,
                        _token:"<?php echo e(csrf_token()); ?>"
                    },
                    success:function(data){
                        console.log(data);
                      $('#amenities').text(data.amenities);
                      $('#rooms').text(data.beds);
                      $('#beds').text(data.rooms);
                      $('#today_booked').text(data.today_booked);
                      $('#today_available').text(data.today_available);
                      $('#active').text(data.active);
                      $('#total').text(data.total);
                      $('#pending_checkin').text(data.pending_checkin);
                      $('#delayed_checkout').text(data.delayed_checkout);
                      $('#upcoming_checkin').text(data.upcoming_checkin);
                      $('#upcoming_checkout').text(data.upcoming_checkout);
                      $('#occupiedBedsId').text(data.occupiedBedsId);
                      $('#vacant_beds').text(data.vacant_beds);
                      $('#vacant_rooms').text(data.vacant_rooms);
                      $('#bed_type_container').html(data.bed_types_data);
                      $('#accommodation_type_container').html(data.accommodation_types_data);
                      
                     displayRoomTypes(data.roomTypesWithCounts);
                     
                    }
                });
            });
    
     $('#change-date').change(function (e)
            {
                e.preventDefault();
                var accommodation = $('#change-accommodation').val();
                var created_at = $('#change-date').val();
                console.log('accommodation'+ accommodation);
                 $.ajax({
                    type:'POST',
                    url:"<?php echo e(route('admin.get-dashboard-data')); ?>",
                    data:{
                        accommodation:accommodation,
                        created_at:created_at,
                        _token:"<?php echo e(csrf_token()); ?>"
                    },
                    success:function(data){
                        console.log(data);
                      $('#amenities').text(data.amenities);
                      $('#rooms').text(data.beds);
                      $('#beds').text(data.rooms);
                      $('#today_booked').text(data.today_booked);
                      $('#today_available').text(data.today_available);
                      $('#active').text(data.active);
                      $('#total').text(data.total);
                      $('#pending_checkin').text(data.pending_checkin);
                      $('#delayed_checkout').text(data.delayed_checkout);
                      $('#upcoming_checkin').text(data.upcoming_checkin);
                      $('#upcoming_checkout').text(data.upcoming_checkout);
                      $('#occupiedBedsId').text(data.occupiedBedsId);
                      $('#vacant_beds').text(data.vacant_beds);
                      $('#vacant_rooms').text(data.vacant_rooms);
                      $('#bed_type_container').html(data.bed_types_data);
                       $('#accommodation_type_container').html(data.accommodation_types_data);
                      
                     displayRoomTypes(data.roomTypesWithCounts);
                     
                    }
                });
            });
            
            function displayRoomTypes(roomTypes) {
                
                var roomTypesContainer = $('#roomTypesContainer');
                roomTypesContainer.empty();
                roomTypes.forEach(function (roomType) {
                    var html = `<div class="col-xxl-3 col-sm-6 position-relative gy-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="widget-two__icon b-radius--5 border border--primary bg-primary">
                                        <i class="la la-city icon-color-efs"></i>
                                    </div>
                                    <div class="widget-two__content">
                                        <h6 class="mb-0">${roomType.name} - ${roomType.accommodation.name}</h6>
                                        <p>Room Count: ${roomType.rooms_count}</p>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/hotel/room?roomType=${roomType.id}&accommodation=${roomType.accommodation.id}" class="widget-two__btn btn btn-outline--primary" style="cursor: pointer">View All</a>
                        </div>
                    </div>`;
                    roomTypesContainer.append(html);
                });
            }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>