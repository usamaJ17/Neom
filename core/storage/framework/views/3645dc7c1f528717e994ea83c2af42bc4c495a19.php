<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.setting.system.configuration.submit')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('User Registration'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you disable this module, no one can register on this system'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->registration): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="registration" type="checkbox">
                                </div>
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Force SSL'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Force SSL (Secure Sockets Layer)'); ?></span>
                                            <?php echo app('translator')->get('the system will force a visitor that he/she must have to visit in secure mode. Otherwise, the site will be loaded in secure mode.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->force_ssl): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="force_ssl" type="checkbox">
                                </div>
                            </li>
                            <?php $hasPermission = App\Models\Role::hasPermission('admin.frontend.sections')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                    <div>
                                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Agree Policy'); ?></p>
                                        <p class="mb-0">
                                            <small><?php echo app('translator')->get('If you enable this module, that means a user must have to agree with your system\'s'); ?> <a href="<?php echo e(route('admin.frontend.sections', 'policy_pages')); ?>"><?php echo app('translator')->get('policies'); ?></a>
                                                <?php echo app('translator')->get('during registration.'); ?></small>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <input <?php if($general->agree): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="agree" type="checkbox">
                                    </div>
                                </li>
                            <?php endif ?>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Force Secure Password'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling this module, a user must set a secure password while signing up or changing the password.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->secure_password): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="secure_password" type="checkbox">
                                </div>
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Email Verification'); ?></p>
                                    <p class="mb-0">
                                        <small>
                                            <?php echo app('translator')->get('If you enable'); ?> <span class="fw-bold"><?php echo app('translator')->get('Email Verification'); ?></span>,
                                            <?php echo app('translator')->get('users have to verify their email to access the dashboard. A 6-digit verification code will be sent to their email to be verified.'); ?>
                                            <br>
                                            <span class="fw-bold"><i><?php echo app('translator')->get('Note'); ?>:</i></span> <i><?php echo app('translator')->get('Make sure that the'); ?>
                                                <span class="fw-bold"><?php echo app('translator')->get('Email Notification'); ?> </span> <?php echo app('translator')->get('module is enabled'); ?></i>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->ev): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="ev" type="checkbox">
                                </div>
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Email Notification'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you enable this module, the system will send emails to users where needed. Otherwise, no email will be sent.'); ?> <code><?php echo app('translator')->get('So be sure before disabling this module that, the system doesn\'t need to send any emails.'); ?></code></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->en): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="en" type="checkbox">
                                </div>
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Mobile Verification'); ?></p>
                                    <p class="mb-0">
                                        <small>
                                            <?php echo app('translator')->get('If you enable'); ?> <span class="fw-bold"><?php echo app('translator')->get('Mobile Verification'); ?></span>,
                                            <?php echo app('translator')->get('users have to verify their mobile to access the dashboard. A 6-digit verification code will be sent to their mobile to be verified.'); ?>
                                            <br>
                                            <span class="fw-bold"><i><?php echo app('translator')->get('Note'); ?>:</i></span> <i><?php echo app('translator')->get('Make sure that the'); ?>
                                                <span class="fw-bold"><?php echo app('translator')->get('SMS Notification'); ?> </span> <?php echo app('translator')->get('module is enabled'); ?></i>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->sv): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="sv" type="checkbox">
                                </div>
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('SMS Notification'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you enable this module, the system will send SMS to users where needed. Otherwise, no SMS will be sent.'); ?> <code><?php echo app('translator')->get('So be sure before disabling this module that, the system doesn\'t need to send any SMS.'); ?></code></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->sn): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="sn" type="checkbox">
                                </div>
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Language Option'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you enable this module, users can change the language according to their needs'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input <?php if($general->multi_language): ?> checked <?php endif; ?> data-bs-toggle="toggle" data-height="35" data-off="<?php echo app('translator')->get('Disable'); ?>" data-offstyle="-danger" data-on="<?php echo app('translator')->get('Enable'); ?>" data-onstyle="-success" data-size="large" data-width="100%" name="multi_language" type="checkbox">
                                </div>
                            </li>

                        </ul>
                    </div>
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.system.configuration.submit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <div class="card-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .toggle.btn-lg {
            height: 37px !important;
            min-height: 37px !important;
        }

        .toggle-handle {
            width: 25px !important;
            padding: 0;
        }

        .form-group {
            width: 125px;
            margin-bottom: 0;
            flex-shrink: 0
        }

        .list-group-item:hover {
            background-color: #F7F7F7;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home5/efsimsa/public_html/neomliving.efsim.sa/core/resources/views/admin/setting/configuration.blade.php ENDPATH**/ ?>