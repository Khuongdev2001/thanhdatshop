
<?php $__env->startSection("title","Thông Tin Thanh Toán"); ?>
<?php $__env->startSection("js"); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<div id="content">
    <div class="container bg-light">
        <div class="checkout">
            <div class="box-top">
                <a href="" class="box-logo fs-18">
                    Logo
                </a>
                <div class="box-process">
                    <span class="process-item">Đăng Nhập</span>
                    <span class="process-item">Địa Chỉ</span>
                    <span class="process-item">Liên Hệ Xác Nhận</span>
                    <span class="process-item">Mua Bán</span>
                </div>
                <a href="" class="box-hotline d-block">
                    <img src="<?php echo e(asset("source/img/web/hotline.png")); ?>" class="thumbnail w-100" alt="">
                </a>
            </div>

            <div class="box-bottom">
                <div class="info-buyer">
                    <p class="title 
                        <?php echo e(["text-pink-weight","text-success","text-primary",-1=>"text-dark"][$cart->cart_status]); ?>

                    fw-600 fs-18">
                        <?php echo e([
                                -1=>"Đơn Hàng Của Bạn Đã Bị Hủy",
                                "Cảm ơn bạn đã đặt hàng tại Tiki Chúng Tôi Sẽ Liên Hệ Bạn Sau",
                                "Bạn Đã Nhận Đơn Hàng Này Rồi. Cảm ơn Bạn Đã Đồng Hành Với Thành Đạt",
                                "Đơn Hàng Của Bạn Đang Vận Chuyển!"
                            ][$cart->cart_status]); ?>

                    </p>
                    <div class="box-cart-code pt-10">
                        <span class="title d-block">Mã đơn hàng của bạn là</span>
                        <span class="cart-code btn btn-round text-light btn-green"><?php echo e($cart->code); ?></span>
                    </div>
                    <div class="box">
                        <div class="info">
                            <h3 class="title">Thông Tin Mua Hàng</h3>
                            <div class="content-group">
                                <span class="label">Họ Và Tên:</span>
                                <span class="content"><?php echo e($cart->buyer_fullname); ?></span>
                            </div>
                            <div class="content-group">
                                <span class="label">Email:</span>
                                <span class="content"><?php echo e($cart->buyer_email); ?></span>
                            </div>
                            <div class="content-group">
                                <span class="label">SĐT:</span>
                                <span class="content"><?php echo e($cart->buyer_phone); ?></span>
                            </div>
                        </div>
                        <div class="address">
                            <h3 class="title">Địa Chỉ Nhận Hàng</h3>
                            <p class="label"><?php echo e($cart->address); ?></p>
                        </div>
                    </div>
                    <div class="box-flex d-flex">
                        <p class="label text-pink-weight fw-600 fs-18">Thắc Mắc Xin Liên Hệ:18008198</p>
                        <div>
                            <a href="<?php echo e(route("home")); ?>" class="mr-10 btn-sm btn btn-round btn-yellow">Tiếp Tục Mua
                                Hàng</a>
                            <a href="" class="btn btn-round btn-show btn-primary btn-sm" data-toggle="modal" data-target="#modal-product">
                                Sản Phẩm >
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box-product">
                    <h3 class="title">Đơn Hàng Của Bạn</h3>
                    <ul class="products">
                        <?php $__currentLoopData = $cartProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-item">
                            <a href="" class="product-thumbnail">
                                <img src="<?php echo e(asset($cartProduct->url)); ?>"
                                    class="thumbnail w-100 h-100" alt="">
                            </a>
                            <div class="product-info px-10">
                                <p class="product-title">
                                    <?php echo e($cartProduct->product_title); ?>

                                </p>
                                <div class="fs-10 py-5 text-primary">
                                    <span class="text-dark">Số Lượng:</span> <?php echo e($cartProduct->qty); ?> 
                                    <span class="text-dark">Giá:</span> <?php echo e(currencyFormat($cartProduct->price)); ?>

                                </div>
                            </div>
                            <span class="product-price">
                                <?php echo e(currencyFormat($cartProduct->price *$cartProduct->qty)); ?>

                            </span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="statistical">
                        <div class="box-flex d-flex">
                            <span class="fs-20 fw-600">Tạm Tính</span>
                            <span class="price fs-20"><?php echo e(currencyFormat($cart->total_price)); ?></span>
                        </div>
                        <div class="box-flex d-flex">
                            <span class="fs-20 fw-600">Tổng Cộng</span>
                            <span class="price fs-20"><?php echo e(currencyFormat($cart->total_price)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="modal d-block" id="modal-product">
                    <div class="modal-dialog bg-light">
                        <div class="modal-header">
                            <a href="" class="btn-exit"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="modal-content">
                            <div class="box-product">
                                <h3 class="title">Đơn Hàng Của Bạn</h3>
                                <ul class="products">
                                    <?php $__currentLoopData = $cartProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="product-item">
                                        <a href="" class="product-thumbnail">
                                            <img src="<?php echo e(asset($cartProduct->url)); ?>"
                                                class="thumbnail w-100 h-100" alt="">
                                        </a>
                                        <div class="product-info px-10">
                                            <p class="product-title">
                                                <?php echo e($cartProduct->product_title); ?>

                                            </p>
                                            <div class="fs-10 py-5 text-primary">
                                                <span class="text-dark">Số Lượng:</span> <?php echo e($cartProduct->qty); ?> 
                                                <span class="text-dark">Giá:</span> <?php echo e(currencyFormat($cartProduct->price)); ?>

                                            </div>
                                        </div>
                                        <span class="product-price">
                                            <?php echo e(currencyFormat($cartProduct->price *$cartProduct->qty)); ?>

                                        </span>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="statistical">
                                    <div class="box-flex d-flex">
                                        <span class="fs-20 fw-600">Tạm Tính</span>
                                        <span class="price fs-20"><?php echo e(currencyFormat($cart->total_price)); ?></span>
                                    </div>
                                    <div class="box-flex d-flex">
                                        <span class="fs-20 fw-600">Tổng Cộng</span>
                                        <span class="price fs-20"><?php echo e(currencyFormat($cart->total_price)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/cart/checkout.blade.php ENDPATH**/ ?>