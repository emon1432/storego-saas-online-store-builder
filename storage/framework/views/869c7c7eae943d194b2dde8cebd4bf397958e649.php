<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php
// $logo = asset(Storage::url('uploads/logo/'));
$logo=\App\Models\Utility::get_file('uploads/logo/');
$profile=\App\Models\Utility::get_file('uploads/profile/');
$logo1=\App\Models\Utility::get_file('uploads/is_cover_image/');

// $logo = asset(Storage::url('uploads/logo/'));
$company_logo = \App\Models\Utility::getValByName('company_logo');
?>

<?php $__env->startPush('script-page'); ?>
    <script>
        var today = new Date()
        var curHr = today.getHours()
        var target = document.getElementById("greetings");

        if (curHr < 12) {
            target.innerHTML = "<?php echo e(__('Good Morning,')); ?>";
        } else if (curHr < 17) {
            target.innerHTML = "<?php echo e(__('Good Afternoon,')); ?>";
        } else {
            target.innerHTML = "<?php echo e(__('Good Evening,')); ?>";
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
// $logo = asset(Storage::url('uploads/logo/'));
$logo=\App\Models\Utility::get_file('uploads/logo/');
$company_logo = \App\Models\Utility::getValByName('company_logo');
$profile=\App\Models\Utility::get_file('uploads/profile/');
$logo1=\App\Models\Utility::get_file('uploads/is_cover_image/');
?>
    <!-- [ Main Content ] start -->
    <?php if(\Auth::user()->type == 'Owner'): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-5">
                        <div class="card">
                            <div class="card-body stats welcome-card">
                                <div class="row align-items-center mb-4">
                                    <div class="col-xxl-12">
                                        <h3 class="mb-1" id="greetings"></h3>
                                        <h4 class="f-w-400">
                                            <a href="<?php echo e(asset(Storage::url('uploads/profile/' . (!empty(Auth::user()->avatar) ? Auth::user()->avatar : 'avatar.png')))); ?>" target="_blank">
                                            
                                                <img
                                                src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>"
                                                    class="wid-35 me-2 img-thumbnail rounded-circle">
                                            </a>
                                            <?php echo e(__(Auth::user()->name)); ?></h4>
                                        <p><?php echo e(__('Have a nice day! Did you know that you can quickly add your favorite product or category to the store?')); ?>

                                        </p>
                                        <div class="dropdown quick-add-btn">
                                            <a class="btn btn-primary btn-q-add dropdown-toggle" data-bs-toggle="dropdown"
                                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="ti ti-plus drp-icon"></i>
                                                <span class="ms-2 me-2"><?php echo e(__('Quick add')); ?></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="<?php echo e(route('product.create')); ?>"
                                                    class="dropdown-item"><span><?php echo e(__('Add new product')); ?></span></a>
                                                <a href="#" data-size="md"
                                                    data-url="<?php echo e(route('product_tax.create')); ?>" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Create New Product Tax')); ?>" class="dropdown-item"
                                                    data-bs-placement="top "><span><?php echo e(__('Add new product tax')); ?></span></a>

                                                <a href="#" data-size="md"
                                                    data-url="<?php echo e(route('product_categorie.create')); ?>"
                                                    data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Create New Product Category')); ?>"
                                                    class="dropdown-item"
                                                    data-bs-placement="top"><span><?php echo e(__('Add new product category')); ?></span></a>

                                                <a href="#" data-size="md"
                                                    data-url="<?php echo e(route('product-coupon.create')); ?>"
                                                    data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Create New Product Coupon')); ?>"
                                                    class="dropdown-item"
                                                    data-bs-placement="top "><span><?php echo e(__('Add new product coupon')); ?></span></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card min-h-390 overflow-auto">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Top Products')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">
                                                    <?php echo e(__('Product')); ?>

                                                </th>
                                                <th scope="col" class="sort" data-sort="budget">
                                                    <?php echo e(__('Quantity')); ?>

                                                </th>
                                                <th scope="col" class="sort text-right" data-sort="completion">
                                                    <?php echo e(__('Price')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $item_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($product->id == $item): ?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <?php if(!empty($product->is_cover)): ?>
                                                                        <a href="<?php echo e($logo1 . $product->is_cover); ?>" target="_blank">
                                                                            <img src="<?php echo e($logo1 . $product->is_cover); ?>"
                                                                                class="wid-25" alt="images">
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a href="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>" target="_blank">
                                                                            <img src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>"
                                                                            class="wid-25" alt="images">
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <div class="ms-3">
                                                                        <h6 class="m-0"><?php echo e($product->name); ?>

                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0"><?php echo e($product->quantity); ?></h6>
                                                            </td>
                                                            <td>
                                                                <small
                                                                    class="text-muted"><?php echo e(\App\Models\Utility::priceFormat($product->price)); ?></small>
                                                                <h6 class="m-0"><?php echo e($totle_qty[$k]); ?>

                                                                    <?php echo e(__('Sold')); ?></h6>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-7">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body stats">
                                        <div class="theme-avtar bg-primary qrcode">
                                            <?php echo QrCode::generate($store_id['store_url']); ?>

                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e($store_id->name); ?></h6>
                                        <a href="#" class="btn btn-primary btn-sm text-sm cp_link"
                                            data-link="<?php echo e($store_id['store_url']); ?>" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="<?php echo e(__('Click to copy link')); ?>"><?php echo e(__('Store Link')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body stats">
                                        <div class="theme-avtar bg-info">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e(__('Total Products')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($newproduct); ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body stats">
                                        <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e(__('Total Sales')); ?></h6>
                                        <h3 class="mb-0"><?php echo e(\App\Models\Utility::priceFormat($totle_sale)); ?>

                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body stats">
                                        <div class="theme-avtar bg-danger">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e(__('Total Orders')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($totle_order); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card min-h-390 overflow-auto">
                            <div class="card-header">
                                <h5><?php echo e(__('Orders')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div id="apex-dashborad" data-color="primary" data-height="230"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Recent Orders')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><?php echo e(__('Orders')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Date')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Value')); ?></th>
                                                <th scope="col" class="sort text-end"><?php echo e(__('Payment Type')); ?></th>
                                                <th scope="col" class="sort text-center"><?php echo e(__('Status')); ?></th>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($new_orders)): ?>
                                                <?php $__currentLoopData = $new_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($order->status != 'Cancel Order'): ?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <a href="<?php echo e(route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id))); ?>"
                                                                        class="btn btn-outline-primary btn-sm text-sm cp_link order-badge"
                                                                        data-link="<?php echo e($store_id['store_url']); ?>" data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Details')); ?>"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="<?php echo e(__('Click to copy link')); ?>">
                                                                        
                                                                        
                                                                        <span
                                                                            class="btn-inner--text"><?php echo e($order->order_id); ?></span>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0">
                                                                    <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                                </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0"><?php echo e($order->name); ?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0">
                                                                    <?php echo e(\App\Models\Utility::priceFormat($order->price)); ?>

                                                                    <h6>
                                                            </td>
                                                            <td class="text-end">
                                                                <h6 class="m-0"><?php echo e($order->payment_type); ?><h6>
                                                            </td>
                                                            <td>
                                                                <div class="actions ml-3">
                                                                    <div class="d-flex row justify-content-center">
                                                                        <button type="button"
                                                                            class="btn btn-sm <?php echo e($order->status == 'pending' ? 'btn-soft-info' : 'btn-soft-success'); ?> btn-icon rounded-pill">
                                                                            <span class="btn-inner--icon">
                                                                                <?php if($order->status == 'pending'): ?>
                                                                                    <i class="fas fa-check soft-info"></i>
                                                                                <?php else: ?>
                                                                                    <i class="fa fa-check-double soft-success"></i>
                                                                                <?php endif; ?>
                                                                            </span>
                                                                            <?php if($order->payment_status == 'approved' && $order->status == 'pending'): ?>
                                                                                <span class="btn-inner--text">
                                                                                    <?php echo e(__('Paid')); ?>:
                                                                                    <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                                                <?php else: ?>
                                                                                </span><span class="btn-inner--text">
                                                                                    <?php echo e(__('Delivered')); ?>:
                                                                                    <?php echo e(\App\Models\Utility::dateFormat($order->updated_at)); ?>

                                                                                </span>
                                                                            <?php endif; ?>

                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a href="<?php echo e(route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id))); ?>"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="<?php echo e(__('Details')); ?>"><i
                                                                            class="ti ti-eye text-white"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php else: ?>
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e(__('Total Store')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($user->total_user); ?></h3>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e(__('Total Orders')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($user->total_orders); ?></h3>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-danger">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 "><?php echo e(__('Total Plans')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($user['total_plan']); ?></h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Recent Orders')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div id="plan_order" data-color="primary" data-height="230"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    <?php endif; ?>
    <!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <?php if(\Auth::user()->type == 'Owner'): ?>
        <script>
            $(document).ready(function() {
                $('.cp_link').on('click', function() {
                    var value = $(this).attr('data-link');
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(value).select();
                    document.execCommand("copy");
                    $temp.remove();
                    show_toastr('Success', '<?php echo e(__('Link copied')); ?>', 'success')
                });
            });

            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        data: <?php echo json_encode($chartData['data']); ?>

                    }],

                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: <?php echo json_encode($chartData['label']); ?>,
                        title: {
                            text: '<?php echo e(__("Days")); ?>'
                        }
                    },
                    colors: ['#e83e8c'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                        title: {
                        text: '<?php echo e(__("Amount")); ?>'
                    },
                    }
                };
                var chart = new ApexCharts(document.querySelector("#apex-dashborad"), options);
                chart.render();
            })();
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#useradd-sidenav',
                offset: 300
            })
        </script>
    <?php else: ?>
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        data: <?php echo json_encode($chartData['data']); ?>

                        // data: [10,20,30,40,50,60,70,40,20,50,60,20,50,70]
                    }],

                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: <?php echo json_encode($chartData['label']); ?>,
                        title: {
                            text: '<?php echo e(__("Days")); ?>'
                        }
                    },
                    colors: ['#e83e8c'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                        title: {
                        text: '<?php echo e(__("Amount")); ?>'
                    },
                    }
                };
                var chart = new ApexCharts(document.querySelector("#plan_order"), options);
                chart.render();
            })();
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/home.blade.php ENDPATH**/ ?>