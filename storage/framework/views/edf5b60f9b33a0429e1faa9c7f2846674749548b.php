<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Coupon Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 "><?php echo e(__('Coupon Detail')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('coupons.index')); ?>"><?php echo e(__('Coupons')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e($coupon->code); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h4 class="my-2"><?php echo e($coupon->code); ?></h4>
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th aria-controls="selection-datatable" rowspan="1" colspan="1"
                                        aria-label=" User: activate to sort column ascending" style="width: 411px;"> User
                                    </th>
                                    <th aria-controls="selection-datatable" rowspan="1" colspan="1"
                                        aria-label=" Date: activate to sort column ascending" style="width: 642px;"> Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $userCoupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userCoupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row" class="odd">
                                        <td><?php echo e(!empty($userCoupon->name) ? $userCoupon->name : ''); ?>

                                        </td>
                                        <td><?php echo e($userCoupon->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/coupon/view.blade.php ENDPATH**/ ?>