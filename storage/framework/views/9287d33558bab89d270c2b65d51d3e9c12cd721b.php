
<?php
    $logo=\App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
    $plan = \App\Models\Plan::where('id', \Auth::user()->plan)->first();
?>


<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar">
<?php endif; ?>
<div class="navbar-wrapper">
    <div class="m-header main-logo">
        
        <a href="<?php echo e(route('dashboard')); ?>" class="b-brand">
          <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
            alt="<?php echo e(config('app.name', 'Storego')); ?>" alt="logo" class="logo logo-lg nav-sidebar-logo">
          </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">
            <?php if(Auth::user()->type == 'Owner'): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' || Request::segment(1) == 'storeanalytic' || Request::route()->getName() == 'orders.show' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="#" class="dash-link"><span class="dash-micon">
                            <i class="ti ti-home"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul
                        class="dash-submenu <?php echo e(Request::segment(1) == 'dashboard' || Request::segment(1) == 'storeanalytic' ? ' show' : ''); ?>">
                        <li class="dash-item <?php echo e(Request::route()->getName() == 'dashboard' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                        </li>
                        <li class="dash-item <?php echo e(Request::route()->getName() == 'storeanalytic' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('storeanalytic')); ?>"><?php echo e(__('Store Analytics')); ?></a>
                        </li>
                        <li
                            class="dash-item <?php echo e(Request::segment(1) == 'orders.index' || Request::route()->getName() == 'orders.show' ? ' active dash-trigger' : 'collapsed'); ?>">
                            <a class="dash-link" href="<?php echo e(route('orders.index')); ?>"><?php echo e(__('Orders')); ?></a>
                        </li>
                    </ul>
                </li>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'product' || Request::segment(1) == 'product_categorie' || Request::segment(1) == 'product_tax' || Request::segment(1) == 'product-coupon' || Request::segment(1) == 'shipping' || Request::segment(1) == 'subscriptions' || Request::segment(1) == 'custom-page' || Request::segment(1) == 'blog' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="#" class="dash-link"><span class="dash-micon">
                            <i class="ti ti-layout-2"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Shop')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu <?php echo e(Request::segment(1) == 'product.index' ? ' show' : ''); ?>">
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'product.index' || Request::route()->getName() == 'product.create' || Request::route()->getName() == 'product.edit' || Request::route()->getName() == 'product.show' || Request::route()->getName() == 'product.grid' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('product.index')); ?>"><?php echo e(__('Products')); ?></a>
                        </li>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'product_categorie.index' ? ' active' : ''); ?>">
                            <a class="dash-link"
                                href="<?php echo e(route('product_categorie.index')); ?>"><?php echo e(__('Product Category')); ?></a>
                        </li>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'product_tax.index' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('product_tax.index')); ?>"><?php echo e(__('Product Tax')); ?></a>
                        </li>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'product-coupon.index' || Request::route()->getName() == 'product-coupon.show' ? ' active' : ''); ?>">
                            <a class="dash-link"
                                href="<?php echo e(route('product-coupon.index')); ?>"><?php echo e(__('Product Coupon')); ?></a>
                        </li>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'subscriptions.index' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('subscriptions.index')); ?>"><?php echo e(__('Subscriber')); ?></a>
                        </li>
                        <?php if(isset($plan->shipping_method) && $plan->shipping_method == 'on'): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'shipping.index' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('shipping.index')); ?>"><?php echo e(__('Shipping')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->additional_page == 'on'): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'custom-page.index' ? ' active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('custom-page.index')); ?>"><?php echo e(__('Custom Page')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->blog == 'on'): ?>
                            <li class="dash-item <?php echo e(Request::route()->getName() == 'blog.index' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('blog.index')); ?>"><?php echo e(__('Blog')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'customer.index' || Request::route()->getName() == 'customer.show' ? ' active dash-trigger ' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('customer.index')); ?>"
                        class="dash-link <?php echo e(request()->is('customer.index') ? 'active' : ''); ?>"><span
                            class="dash-micon">
                            <i class="ti ti-user"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Customers')); ?></span></a>
                </li>
            <?php endif; ?>
            <?php if(Auth::user()->type == 'super admin'): ?>
                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>"
                        class="dash-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>"><span class="dash-micon">
                            <i class="ti ti-home"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                </li>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'store-resource' || Request::route()->getName() == 'store.grid' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('store-resource.index')); ?>"
                        class="dash-link <?php echo e(request()->is('store-resource') ? 'active' : ''); ?>"><span
                            class="dash-micon">
                            <i data-feather="user"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Stores')); ?></span></a>
                </li>
                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'coupons' ? ' active' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('coupons.index')); ?>"
                        class="dash-link <?php echo e(request()->is('coupons') ? 'active' : ''); ?>"><span class="dash-micon">
                            <i class="ti ti-tag"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Coupons')); ?></span></a>
                </li>
            <?php endif; ?>
            <li
                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'plans' || Request::route()->getName() == 'stripe' ? ' active dash-trigger' : 'collapsed'); ?>">
                <a href="<?php echo e(route('plans.index')); ?>"
                    class="dash-link <?php echo e(request()->is('plans') ? 'active' : ''); ?>"><span class="dash-micon">
                        <i class="ti ti-trophy"></i>
                    </span><span class="dash-mtext"><?php echo e(__('Plans')); ?></span></a>
            </li>
            <?php if(Auth::user()->type == 'super admin'): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'plan_request' ? ' active' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('plan_request.index')); ?>"
                        class="dash-link <?php echo e(request()->is('plan_request') ? 'active' : ''); ?>"><span class="dash-micon">
                            <i class="ti ti-brand-telegram"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Plan Requests')); ?></span></a>
                </li>

                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'manage.email.language' || Request::route()->getName() == 'manage.email.language' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('manage.email.language', \Auth::user()->lang)); ?>"
                        class="dash-link <?php echo e(request()->is('email_template') ? 'active' : ''); ?>"><span
                            class="dash-micon">
                            <i class="ti ti-mail"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Email Templates')); ?></span></a>
                </li>
            <?php endif; ?>
            <li
                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' || Request::route()->getName() == 'store.editproducts' ? ' active dash-trigger' : 'collapsed'); ?>">
                <a href="<?php echo e(route('settings')); ?>" class="dash-link <?php echo e(request()->is('settings') ? 'active' : ''); ?>">
                    <span class="dash-micon"> <i class="ti ti-settings"></i>
                    </span><span class="dash-mtext">
                        <?php if(Auth::user()->type == 'super admin'): ?>
                            <?php echo e(__('Settings')); ?>

                        <?php else: ?>
                            <?php echo e(__('Store Settings')); ?>

                        <?php endif; ?>
                    </span></a>
            </li>
        </ul>
    </div>
</div>
</nav>
<?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/partials/admin/menu.blade.php ENDPATH**/ ?>