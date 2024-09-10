<div class="sidebar bg--dark"">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a class="sidebar__main-logo" href="<?php echo e(route('admin.dashboard')); ?>"><img alt="<?php echo app('translator')->get('image'); ?>" src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo_dark.png')); ?>"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.dashboard')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.dashboard')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.hotel.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a class="<?php echo e(menuActive('admin.hotel*', 3)); ?>" href="javascript:void(0)">
                            <i class="menu-icon las la-city"></i>
                            <span class="menu-title" style="font-size: 0.65rem !important;">Manage Accommodation</span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.hotel*', 2)); ?>">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accommodations.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.accommodations.*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.accommodations.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Accommodation'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.amenity.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.amenity.all')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.amenity.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Amenities'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.complement.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.complement.all')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.complement.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Complements'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.type.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.room.type.*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.room.type.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Room Types'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                
                                 <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room-item.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.room-item.all*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.room-item.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Room Items'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.bed.all')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.bed.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Room'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.accessories.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.accessories.all')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.accessories.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Bed Accessories'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                
                                 <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.bed.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.newbed.all')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.newbed.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Bed Type'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.room.all*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.room.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Bed'); ?></span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.room.getVacantRoom')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.room.getVacantRoom')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Vacant Bed'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                
                                 <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.room.status.*')); ?>">
                                    <a class="nav-link" href="<?php echo e(route('admin.hotel.room.status.list')); ?>">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title"><?php echo app('translator')->get('Bed Status'); ?></span>
                                    </a>
                                </li>
                            
                                
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.roomKey.all*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.roomKey.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Bed Key'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.extra_services.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.extra_services.*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.extra_services.all')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Extra Services'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                     <li class="sidebar__menu-header"><?php echo app('translator')->get('Inspection'); ?></li>
                         <?php $hasPermission = App\Models\Role::hasPermission('admin.hotel.room-item.inspection')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.hotel.room-item.inspection*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.hotel.room-item.inspection')); ?>">
                                            <i class="menu-icon las la-search transform-180"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Room Items Inspection'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                <?php endif ?>
                     <li class="sidebar-menu-item sidebar-dropdown">
                        <a class="<?php echo e(menuActive('admin.lostFounditem',3)); ?> <?php echo e(menuActive('admin.foundby',3)); ?> <?php echo e(menuActive('admin.handedOverBy',3)); ?> <?php echo e(menuActive('admin.handedOverto',3)); ?>" href="javascript:void(0)">
                            <i class="menu-icon las la-city"></i>
                            <span class="menu-title" style="font-size: 0.65rem !important;">Lost and found item</span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.lostFounditem',2)); ?> <?php echo e(menuActive('admin.foundby',2)); ?> <?php echo e(menuActive('admin.handedOverBy',2)); ?> <?php echo e(menuActive('admin.handedOverto',2)); ?>">
                            <ul>
                               
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.lostFounditem')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.lostFounditem')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Lost and found item </span>
                                        </a>
                                    </li>
                                   <li class="sidebar-menu-item <?php echo e(menuActive('admin.foundby')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.foundby')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Found By</span>
                                        </a>
                                    </li>
                                     <li class="sidebar-menu-item <?php echo e(menuActive('admin.handedOverBy')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.handedOverBy')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Handed Over By</span>
                                        </a>
                                    </li>
                                     <li class="sidebar-menu-item <?php echo e(menuActive('admin.handedOverto')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.handedOverto')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Handed Over To</span>
                                        </a>
                                    </li>
                              
                              
                            </ul>
                        </div>
                    </li>
                    
                     <?php $hasPermission = App\Models\Role::hasPermission(['admin.booking.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive(['admin.booking.*'], 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon las la-list"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Manage Bookings'); ?></span>
                                <?php if($delayedCheckoutCount || $refundableBookingCount): ?>
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                <?php endif; ?>
                            </a>

                            <div class="sidebar-submenu <?php echo e(menuActive(['admin.booking.*'], 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.todays.booked')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.todays.booked')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.todays.booked')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Todays Booked'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.todays.checkin')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.todays.checkin')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.todays.checkin')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Todays Checkin'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.todays.checkout')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.todays.checkout')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.todays.checkout')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Todays Checkout'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.active')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.active')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.active')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Active Bookings'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.checked.out.list')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.checked.out.list')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.checked.out.list')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Checked Out Bookings'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.canceled.list')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.canceled.list')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.canceled.list')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Canceled Bookings'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <!--<?php $hasPermission = App\Models\Role::hasPermission('admin.booking.refundable')  ? 1 : 0;
            if($hasPermission == 1): ?>-->
                                    <!--    <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.refundable')); ?>">-->
                                    <!--        <a class="nav-link" href="<?php echo e(route('admin.booking.refundable')); ?>">-->
                                    <!--            <i class="menu-icon las la-dot-circle"></i>-->
                                    <!--            <span class="menu-title"><?php echo app('translator')->get('Refundable Bookings'); ?></span>-->
                                    <!--            <?php if($refundableBookingCount): ?>-->
                                    <!--                <span class="menu-badge pill bg--danger ms-auto">-->
                                    <!--                    <?php echo e($refundableBookingCount); ?>-->
                                    <!--                </span>-->
                                    <!--            <?php endif; ?>-->
                                    <!--        </a>-->
                                    <!--    </li>-->
                                    <!--<?php endif ?>-->

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.checkout.delayed')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.checkout.delayed')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.checkout.delayed')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Delayed Checkout'); ?></span>
                                                <?php if($delayedCheckoutCount): ?>
                                                    <span class="menu-badge pill bg--danger ms-auto">
                                                        <?php echo e($delayedCheckoutCount); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.booking.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.booking.all')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.booking.all')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('All Bookings'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>
                    
                     
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.upcoming.booking.*', 'admin.book.room', 'admin.booking.*', 'admin.extra.service.*', 'admin.deposit.*', 'admin.delayed.booking.checkout', 'admin.pending.booking.checkin'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Booking'); ?></li>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.delayed.booking.checkout')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.delayed.booking.checkout')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.delayed.booking.checkout')); ?>">
                                <i class="menu-icon las la-calendar-day"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Delayed Checkouts'); ?></span>
                                <?php if($delayedCheckoutCount): ?>
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <?php echo e($delayedCheckoutCount); ?>

                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.pending.booking.checkin')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.pending.booking.checkin')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.pending.booking.checkin')); ?>">
                                <i class="menu-icon la la-spinner"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Pending Check-Ins'); ?></span>
                                <?php if($pendingCheckInsCount): ?>
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <?php echo e($pendingCheckInsCount); ?>

                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.upcoming.booking.checkin')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.upcoming.booking.checkin')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.upcoming.booking.checkin')); ?>">
                                <i class="menu-icon la la-sign-in"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Upcoming Check-Ins'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.upcoming.booking.checkout')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.upcoming.booking.checkout')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.upcoming.booking.checkout')); ?>">
                                <i class="menu-icon la la-sign-out transform-rotate-180"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Upcoming Checkouts'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.book.room')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.book.room')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.book.room')); ?>">
                                <i class="menu-icon la la-hand-o-right"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Book Room'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                   

                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.extra.service.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.extra.service*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon las la-clipboard-list"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Extra Service'); ?> </span>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.extra.service*', 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.extra.service.add')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.extra.service.add')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.extra.service.add')); ?>">
                                                <i class="menu-icon las la-plus-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Add Extra Service'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.extra.service.list')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.extra.service.list')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.extra.service.list')); ?>">
                                                <i class="menu-icon las la-list"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Added Extra Services'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>











































































                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.staff.*', 'admin.roles.*', 'admin.users.*', 'admin.subscriber.index'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Actors'); ?></li>

                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.staff.*', 'admin.roles.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive(['admin.staff*', 'admin.roles.*'], 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon las la-users"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Manage Guest'); ?></span>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive(['admin.staff*', 'admin.roles.*'], 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff*')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.staff.index')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('All Guest'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.transferstaff')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.transferStaff')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.staff.transferStaff')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Transfer Guest'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.roles.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.roles*')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.roles.index')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Roles'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.users.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.users*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon las la-users"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Registered Guests'); ?></span>
                                <?php if($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0): ?>
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                <?php endif; ?>
                            </a>

                            <div class="sidebar-submenu <?php echo e(menuActive('admin.users*', 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.active')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.active')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.users.active')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Active Guests'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.banned')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.banned')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.users.banned')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Banned Guests'); ?></span>
                                                <?php if($bannedUsersCount): ?>
                                                    <span class="menu-badge pill bg--danger ms-auto"><?php echo e($bannedUsersCount); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.email.unverified')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.email.unverified')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.users.email.unverified')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Email Unverified'); ?></span>

                                                <?php if($emailUnverifiedUsersCount): ?>
                                                    <span class="menu-badge pill bg--danger ms-auto"><?php echo e($emailUnverifiedUsersCount); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.mobile.unverified')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.mobile.unverified')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.users.mobile.unverified')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Mobile Unverified'); ?></span>
                                                <?php if($mobileUnverifiedUsersCount): ?>
                                                    <span class="menu-badge pill bg--danger ms-auto"><?php echo e($mobileUnverifiedUsersCount); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.transfer')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.users.transfer')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Transfer Guests'); ?></span>
                                        </a>
                                    </li>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.all')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.users.all')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('All Guests'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <hr class="my-0">

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.users.notification.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.notification.all')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.users.notification.all')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Send Notification to All'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.subscriber.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.subscriber.index')); ?>">
                            <a class="nav-link" data-default-url="<?php echo e(route('admin.subscriber.index')); ?>" href="<?php echo e(route('admin.subscriber.index')); ?>">
                                <i class="menu-icon las la-thumbs-up"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Subscribers'); ?> </span>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.ticket.*', 'admin.report*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Support & Report'); ?></li>
                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.ticket.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.ticket*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon la la-ticket"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Support Tickets'); ?> </span>
                                <?php if(0 < $pendingTicketCount): ?>
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.ticket*', 2)); ?> ">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.pending')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.pending')); ?> ">
                                            <a class="nav-link" href="<?php echo e(route('admin.ticket.pending')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Pending Ticket'); ?></span>
                                                <?php if($pendingTicketCount): ?>
                                                    <span class="menu-badge pill bg--danger ms-auto"><?php echo e($pendingTicketCount); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.closed')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.closed')); ?> ">
                                            <a class="nav-link" href="<?php echo e(route('admin.ticket.closed')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Closed Ticket'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.answered')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.answered')); ?> ">
                                            <a class="nav-link" href="<?php echo e(route('admin.ticket.answered')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Answered Ticket'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.index')); ?> ">
                                            <a class="nav-link" href="<?php echo e(route('admin.ticket.index')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('All Ticket'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.report*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.report*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Reports'); ?> </span>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.report*', 2)); ?>">
                                <ul>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.report.booking.history')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.booking.history')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.report.booking.history')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Booking Actions'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>



















                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.report.notification.history')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.notification.history')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.report.notification.history')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Notification History'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.report.login.history')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.login.history', 'admin.report.login.ipHistory'])); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.report.login.history')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Guests Login History'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    
                                    
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.report.bedCountReport')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.bedCountReport')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.report.bedCountReport')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Bed Report'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    
                                    
                                        
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.booking')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.report.booking')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Booking Report'); ?></span>
                                            </a>
                                        </li>

                                </ul>
                            </div>
                        </li>
                    <?php endif ?>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.setting.index', 'admin.setting.system.configuration', 'admin.setting.logo.icon', 'admin.setting.notification.*', 'admin.gateway.*', 'admin.extensions.index', 'admin.language.manage', 'admin.seo'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('System Settings'); ?></li>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.index')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.setting.index')); ?>">
                                <i class="menu-icon las la-life-ring"></i>
                                <span class="menu-title"><?php echo app('translator')->get('General Setting'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.system.configuration')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.system.configuration')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.setting.system.configuration')); ?>">
                                <i class="menu-icon las la-cog"></i>
                                <span class="menu-title"><?php echo app('translator')->get('System Configuration'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.gateway.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.gateway*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon las la-credit-card"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Payment Gateways'); ?></span>

                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.gateway*', 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.gateway.automatic.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.gateway.automatic.index')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.gateway.automatic.index')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Automatic Gateways'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.gateway.manual.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.gateway.manual.index')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.gateway.manual.index')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Manual Gateways'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.logo.icon')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.logo.icon')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.setting.logo.icon')); ?>">
                                <i class="menu-icon las la-images"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Logo & Favicon'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.extensions.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.extensions.index')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.extensions.index')); ?>">
                                <i class="menu-icon las la-cogs"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Extensions'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.language.manage')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive(['admin.language.manage', 'admin.language.key'])); ?>">
                            <a class="nav-link" data-default-url="<?php echo e(route('admin.language.manage')); ?>" href="<?php echo e(route('admin.language.manage')); ?>">
                                <i class="menu-icon las la-language"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Language'); ?> </span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.seo')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.seo')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.seo')); ?>">
                                <i class="menu-icon las la-globe"></i>
                                <span class="menu-title"><?php echo app('translator')->get('SEO Manager'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.setting.notification.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.setting.notification*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon las la-bell"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Notification Setting'); ?></span>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.setting.notification*', 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.global')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.global')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.setting.notification.global')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Global Template'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>

                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.email')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.email')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.setting.notification.email')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Email Setting'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.sms')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.sms')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.setting.notification.sms')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('SMS Setting'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.templates')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.templates')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.setting.notification.templates')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Notification Templates'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.frontend*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Frontend Manager'); ?></li>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.frontend.templates')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.templates')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.frontend.templates')); ?>">
                                <i class="menu-icon la la-html5"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Manage Templates'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.frontend.manage.pages')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.manage.pages')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.frontend.manage.pages')); ?>">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Manage Pages'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.frontend.sections')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.frontend.sections*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon la la-puzzle-piece"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Manage Section'); ?></span>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.frontend.sections*', 2)); ?>">
                                <ul>
                                    <?php
                                        $lastSegment = collect(request()->segments())->last();
                                    ?>
                                    <?php $__currentLoopData = getPageSections(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $secs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($secs['builder']): ?>
                                            <li class="sidebar-menu-item <?php if($lastSegment == $k): ?> active <?php endif; ?>">
                                                <a class="nav-link" href="<?php echo e(route('admin.frontend.sections', $k)); ?>">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title"><?php echo e(__($secs['name'])); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>

                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.system.*', 'admin.maintenance.mode', 'admin.setting.cookie', 'admin.setting.custom.css', 'admin.request.report'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Extra'); ?></li>
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.maintenance.mode')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.maintenance.mode')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.maintenance.mode')); ?>">
                                <i class="menu-icon las la-robot"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Maintenance Mode'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.cookie')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.cookie')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.setting.cookie')); ?>">
                                <i class="menu-icon las la-cookie-bite"></i>
                                <span class="menu-title"><?php echo app('translator')->get('GDPR Cookie'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.system.*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="<?php echo e(menuActive('admin.system*', 3)); ?>" href="javascript:void(0)">
                                <i class="menu-icon la la-server"></i>
                                <span class="menu-title"><?php echo app('translator')->get('System'); ?></span>
                            </a>
                            <div class="sidebar-submenu <?php echo e(menuActive('admin.system*', 2)); ?>">
                                <ul>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.system.info')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.info')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.system.info')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Application'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.system.server.info')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.server.info')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.system.server.info')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Server'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.system.optimize')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.optimize')); ?>">
                                            <a class="nav-link" href="<?php echo e(route('admin.system.optimize')); ?>">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title"><?php echo app('translator')->get('Cache'); ?></span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>

                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.custom.css')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.custom.css')); ?>">
                            <a class="nav-link" href="<?php echo e(route('admin.setting.custom.css')); ?>">
                                <i class="menu-icon lab la-css3-alt"></i>
                                <span class="menu-title"><?php echo app('translator')->get('Custom CSS'); ?></span>
                            </a>
                        </li>
                    <?php endif ?>

                <?php endif ?>
            </ul>
            <div class="text-uppercase mb-3 text-center">
                <span class="text--primary"><?php echo e($general?->site_name); ?></span>
                <span class="text--success"><?php echo app('translator')->get('V'); ?><?php echo e(systemDetails()['version']); ?> </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

<?php $__env->startPush('style'); ?>
    <style>
        .transform-rotate-180 {
            transform: rotate(180deg)
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/partials/sidenav.blade.php ENDPATH**/ ?>