<?php
$logo = asset(Storage::url('uploads/logo/'));
$favicon = \App\Models\Utility::getValByName('company_favicon');
$settings = Utility::settings();

?>

<head>
    <meta charset="utf-8"  dir="<?php echo e($settings['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=  ">
    <meta name="description" content="<?php echo e(env('APP_NAME')); ?> - Online Store Builder">

    <title>
        <?php echo e(\App\Models\Utility::getValByName('title_text') ? \App\Models\Utility::getValByName('title_text') : env('APP_NAME', 'StoreGo SaaS')); ?>

        - <?php echo $__env->yieldContent('page-title'); ?>
    </title>
    
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <link rel="icon" href="<?php echo e($logo . '/favicon.png'); ?>" type="image" sizes="16x16">
    <?php else: ?>
        <link rel="icon" href="<?php echo e($logo . '/' . (isset($favicon) && !empty($favicon) ? $favicon : 'favicon.png')); ?>"
            type="image" sizes="16x16">
    <?php endif; ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css')); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <!-- <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>"> -->
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/animate.css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/select2/dist/css/select2.min.css')); ?>">
    <!-- vendor css -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/landing.css')); ?>">



    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/custom.css')); ?>">

    <?php if(isset($settings['SITE_RTL']) && $settings['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <?php if($settings['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('css-page'); ?>
</head>
<?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/partials/admin/head.blade.php ENDPATH**/ ?>