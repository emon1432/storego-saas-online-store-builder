<?php
$currantLang = $users->currentLanguages();
$profile=\App\Models\Utility::get_file('uploads/profile/');
if ($currantLang == null)
{
   $currantLang = "en";
}
?>

<!-- [ Header ] start -->

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
<?php else: ?>
    <header class="dash-header">
<?php endif; ?>
    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="theme-avtar">
                            
                                <img alt="#" style="width:30px;"
                                src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>"
                                   class="header-avtar">
                        </span>
                        <span class="hide-mob ms-2"><?php echo e(__('Hi,')); ?> <?php echo e(Auth::user()->name); ?>!</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        <?php if(Auth::user()->type == 'Owner'): ?>
                            <?php $__currentLoopData = Auth::user()->stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($store->is_active): ?>
                                    <a href="<?php if(Auth::user()->current_store == $store->id): ?> # <?php else: ?> <?php echo e(route('change_store', $store->id)); ?> <?php endif; ?>"
                                        title="<?php echo e($store->name); ?>" class="dropdown-item">
                                        <span><?php echo e($store->name); ?></span>
                                        <?php if(Auth::user()->current_store == $store->id): ?>
                                            <i class="fas fa-check px-2"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php else: ?>
                                    <a href="#" class="dropdown-item notify-item" title="<?php echo e(__('Locked')); ?>">
                                        <i class="fas fa-lock"></i>
                                        <span><?php echo e($store->name); ?></span>
                                        <?php if(isset($store->pivot->permission)): ?>
                                            <?php if($store->pivot->permission == 'Owner'): ?>
                                                <span
                                                    class="badge badge-primary"><?php echo e(__($store->pivot->permission)); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="dropdown-divider"></div>
                            <?php if(auth()->guard('web')->check()): ?>
                                <?php if(Auth::user()->type == 'Owner'): ?>
                                    <a href="#" data-size="lg" data-url="<?php echo e(route('store-resource.create')); ?>"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Create New Store')); ?>"
                                        class="dropdown-item">
                                        <i class="ti ti-plus"></i></i><span><?php echo e(__('Create New Store')); ?></span>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <hr>
                        <?php endif; ?>
                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
                            <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob"><?php echo e(Str::upper($currantLang)); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end" aria-labelledby="dropdownLanguage">
                        <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language', $lang)); ?>"
                                class="dropdown-item <?php echo e(basename(App::getLocale()) == $lang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($lang)); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->type == 'super admin'): ?>
                            <div class="dropdown-divider m-0"></div>
                            <a href="<?php echo e(route('manage.language', [$currantLang])); ?>"
                                class="dropdown-item border-top py-1 text-primary"><?php echo e(__('Manage Languages')); ?></a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/partials/admin/header.blade.php ENDPATH**/ ?>