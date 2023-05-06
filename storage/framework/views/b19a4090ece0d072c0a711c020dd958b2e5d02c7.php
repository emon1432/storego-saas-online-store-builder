<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Coupons')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 "><?php echo e(__('Coupons')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Coupons')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="pr-2">
        <a href="#" data-size="md" data-url="<?php echo e(route('coupons.create')); ?>"  data-ajax-popup="true"
        data-title="<?php echo e(__('Add Coupon')); ?>"  class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
            data-bs-placement="top" title="<?php echo e(__('Add Coupon')); ?>"><i class="ti ti-plus"></i></i></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
 <!-- [ Main Content ] start -->
 <div class="row">
    <!-- [ basic-table ] start -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Code')); ?></th>
                                <th> <?php echo e(__('Discount (%)')); ?></th>
                                <th> <?php echo e(__('Limit')); ?></th>
                                <th> <?php echo e(__('Used')); ?></th>
                                <th> <?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($coupon->name); ?></td>
                                <td><?php echo e($coupon->code); ?></td>
                                <td><?php echo e($coupon->discount); ?></td>
                                <td><?php echo e($coupon->limit); ?></td>
                                <td><?php echo e($coupon->used_coupon()); ?></td>
                                <td class="Action">
                                    <span>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="<?php echo e(route('coupons.show',$coupon->id)); ?>"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="<?php echo e(__('View')); ?>"><i
                                                    class="ti ti-eye text-white"></i></a>
                                        </div>

                                        <div class="action-btn  bg-info ms-2">
                                            <a href="#" data-size="md"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="tooltip" data-ajax-popup="true"
                                                data-url="<?php echo e(route('coupons.edit',[$coupon->id])); ?>"
                                                data-title="<?php echo e(__('Edit Coupon')); ?>" data-bs-placement="top"
                                                title="<?php echo e(__('Edit')); ?>"><i
                                                    class="ti ti-pencil text-white"></i></a>
                                        </div>

                                        <div class="action-btn bg-danger ms-2">
                                            <a class="bs-pass-para align-items-center btn btn-sm d-inline-flex"
                                                href="#" data-title="<?php echo e(__('Delete Lead')); ?>"
                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                data-confirm-yes="delete-form-<?php echo e($coupon->id); ?>"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="<?php echo e(__('Delete')); ?>">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['coupons.destroy', $coupon->id], 'id' => 'delete-form-' . $coupon->id]); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </span>
                                </td>


                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- [ basic-table ] end -->
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/coupon/index.blade.php ENDPATH**/ ?>