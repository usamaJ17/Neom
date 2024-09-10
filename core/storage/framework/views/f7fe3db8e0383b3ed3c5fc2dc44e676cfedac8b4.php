<!-- navbar-wrapper start -->
<nav class="navbar-wrapper bg--dark d-print-none" style="position:sticky;top:0;z-index:9">
    <div class="navbar__left">
        <button class="res-sidebar-open-btn me-3" type="button"><i class="las la-bars"></i></button>
        <form class="navbar-search">
            <input autocomplete="off" class="navbar-search-field" id="searchInput" name="#0" placeholder="<?php echo app('translator')->get('Search here...'); ?>" type="search">
            <i class="las la-search"></i>
            <ul class="search-list"></ul>
        </form>
        <?php
            $accommodations = \App\Models\Accommodation::distinct()->get();
        ?>
        <form class="mx-10" id="change_accommodation" method="post" action="<?php echo e(route('admin.change_accommodation')); ?>">
            <?php echo csrf_field(); ?>
            <!--<label for="accommodation"><?php echo e(__('Accommodation')); ?><span class="text-red">*</span></label>-->
            <select onchange="$('#change_accommodation').submit();" name="admin_accommodation_id" id="admin_accommodation_id" class="form-select">
                <option value="" selected>All Accommodations</option>
                    <?php if(isset($accommodations)): ?>
                        <?php $__currentLoopData = $accommodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accommodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($accommodation->name <> ''): ?>
                            <option <?php echo e(auth()->guard('admin')->user()->accommodation_id == $accommodation->id ? 'selected' : ''); ?> value="<?php echo e($accommodation->id); ?>"><?php echo e($accommodation->name); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
            </select>
        </form>
        
        
    </div>
    <div class="navbar__right">
        <ul class="navbar__action-list">
                

            <?php $hasPermission = App\Models\Role::hasPermission(['admin.notification.read', 'admin.notifications'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="dropdown">
                    <button aria-expanded="false" aria-haspopup="true" class="primary--layer" data-bs-toggle="dropdown" data-display="static" type="button" class="position-relative">
                        <i class="las la-bell text--primary <?php if($adminNotificationCount > 0): ?> icon-left-right <?php endif; ?>"></i>
                        <span class="position-absolute top-0 start-5 <?php if($adminNotificationCount > 0): ?> icon-left-right <?php endif; ?> text-dark bg-white rounded-circle" style="width: 15px; left:1px; font-size:10px"><?php echo e($adminNotificationCount); ?></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                        <div class="dropdown-menu__header">
                            <span class="caption"><?php echo app('translator')->get('Notification'); ?></span>
                            <?php if($adminNotificationCount > 0): ?>
                                <p><?php echo app('translator')->get('You have'); ?> <?php echo e($adminNotificationCount); ?> <?php echo app('translator')->get('unread notification'); ?></p>
                            <?php else: ?>
                                <p><?php echo app('translator')->get('No unread notification found'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="dropdown-menu__body">
                            <?php $__currentLoopData = $adminNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-menu__item" href="<?php if(can('admin.notification.read')): ?> <?php echo e(route('admin.notification.read', $notification->id)); ?> <?php else: ?> javascript:void(0) <?php endif; ?>">
                                    <div class="navbar-notifi">
                                        <div class="navbar-notifi__right">
                                            <h6 class="notifi__title"><?php echo e(__($notification->title)); ?></h6>
                                            <span class="time"><i class="far fa-clock"></i>
                                                <?php echo e($notification->created_at->diffForHumans()); ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $hasPermission = App\Models\Role::hasPermission('admin.notifications')  ? 1 : 0;
            if($hasPermission == 1): ?>
                            <div class="dropdown-menu__footer">
                                <a class="view-all-message" href="<?php echo e(route('admin.notifications')); ?>"><?php echo app('translator')->get('View all notification'); ?></a>
                            </div>
                        <?php endif ?>
                    </div>
                </li>
            <?php endif ?>

            <li class="dropdown">
                <button aria-expanded="false" aria-haspopup="true" class="" data-bs-toggle="dropdown" data-display="static" type="button">
                    <span class="navbar-user">
                        <span class="navbar-user__thumb"><img alt="image" src="<?php echo e(getImage('assets/admin/images/profile/' .auth()->guard('admin')->user()->image)); ?>"></span>
                        <span class="navbar-user__info">
                            <span class="navbar-user__name"><?php echo e(auth()->guard('admin')->user()->username); ?></span>
                        </span>
                        <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2" href="<?php echo e(route('admin.profile')); ?>">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption"><?php echo app('translator')->get('Profile'); ?></span>
                    </a>

                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2" href="<?php echo e(route('admin.password')); ?>">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption"><?php echo app('translator')->get('Password'); ?></span>
                    </a>

                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2" href="<?php echo e(route('admin.logout')); ?>">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption"><?php echo app('translator')->get('Logout'); ?></span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->
<?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/partials/topnav.blade.php ENDPATH**/ ?>