<?php
// get theme color
$setting = App\Models\Utility::colorset();

$settings = Utility::settings();
$color = 'theme-3';
if (!empty($setting['color'])) {
    $color = $setting['color'];
}
$users = \Auth::user();
$currantLang = $users->currentLanguages();
$languages = \App\Models\Utility::languages();
$footer_text = isset(\App\Models\Utility::settings()['footer_text']) ? \App\Models\Utility::settings()['footer_text'] : '';
?>

<!DOCTYPE html>
<html lang="en" dir="<?php echo e(isset($settings['SITE_RTL']) && $settings['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="<?php echo e($color); ?>">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- [ navigation menu ] start -->
    <?php echo $__env->make('partials.admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- [ Header ] start -->
    <?php echo $__env->make('partials.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- [ Main Content ] start -->
    <div class="page-content">
        <div class="dash-container">
            <div class="dash-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                
                                <div class="page-header-title">
                                    <h4 class="m-b-10"><?php echo $__env->yieldContent('page-title'); ?></h4>
                                </div>
                                <ul class="breadcrumb">
                                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="col-12">
                                    <?php echo $__env->yieldContent('filter'); ?>
                                </div>
                                <div class="col-12 text-end">
                                    <?php echo $__env->yieldContent('action-btn'); ?>
                                </div>
                            </div>
                                
                            
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commonModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

    <?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/layouts/admin.blade.php ENDPATH**/ ?>