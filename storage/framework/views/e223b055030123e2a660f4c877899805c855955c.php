
<?php $__env->startSection("title","Danh Sách Giỏ Hàng"); ?>
<?php $__env->startSection("js"); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<div class="container">
    <div id="content">
        <?php if(auth()->guard()->guest()): ?>
            <div id="wp-cart" class="text-center">
                <p class="py-30">Vui Lòng Đăng Nhập Để Tiếp Tục !</p>
                <a href="" class="btn btn-yellow btn-round" data-toggle="modal" data-target="#modal-login">Đăng Nhập</a>
            </div>
        <?php endif; ?>
        <?php if(auth()->guard()->check()): ?>
        <div id="wp-cart">
            <?php if(!empty($userAddress)): ?>
                <h3 class="title">Giỏ Hàng Của Bạn</h3>
                <?php if(session("cart.cartInfo.totalProduct")): ?>
                <div id="cart">
                    <div class="table-cart">
                        <div class="table-head">
                            <div class="col-table-1">
                                <span clas>Tất cả Sản Phẩm (<span class="total-qty"><?php echo e($cartInfo["totalQty"]); ?></span>)</span>
                            </div>
                            <div class="col-table-2">
                                <span>
                                    Đơn Giá
                                </span>
                            </div>
                            <div class="col-table-3">
                                <span>
                                    Số Lượng
                                </span>
                            </div>
                            <div class="col-table-4">
                                <span>
                                    T.Tiền
                                </span>
                            </div>
                            <div class="col-table-5">
                                <span>
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </div>
                        </div>
                        <div class="table-body">
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cart-item bg-light">
                                <div class="col-table-1">
                                    <div class="d-flex">
                                        <a href="" class="product-thumbnail round-5 overflow-hidden">
                                            <img data-src="<?php echo e($cartItem['product_thumbnail']); ?>"
                                                alt="<?php echo e($cartItem["product_title"]); ?>"
                                                class="thumbnail w-100 lazy">
                                        </a>
                                        <a href="" class="product-name">
                                        <?php echo e($cartItem["product_title"]); ?>

                                        </a>
                                    </div>
                                </div>
                                <div class="col-table-2">
                                    <?php echo e(currencyFormat($cartItem["price"])); ?>

                                </div>
                                <div class="col-table-3">
                                    <div class="form-group-qty"  data-id="<?php echo e($key); ?>">
                                        <a href="" class="btn-increase">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        <input type="text" class="qty" value="<?php echo e($cartItem["qty"]); ?>"  disabled>
                                        <a href="" class="btn-decrease">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-table-4">
                                    <?php echo e(currencyFormat($cartItem["total_price"])); ?>

                                </div>
                                <div class="col-table-5">
                                    <a href="" data-id="<?php echo e($key); ?>" class="btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class=" table-body-mobile d-none">
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cart-item px-10 bg-light my-10">
                                <input type="checkbox" class="" name="" id="">
                                <a href="" class="product-thumbnail mx-10 round-5 overflow-hidden">
                                    <img src="<?php echo e(asset($cartItem["product_thumbnail"])); ?>" 
                                        alt="<?php echo e($cartItem["product_title"]); ?>"
                                        class="thumbnail w-100 h-100">
                                </a>
                                <div class="cart-details">
                                    <a href="" class="product-name">
                                        <?php echo e($cartItem["product_title"]); ?>

                                    </a>
                                    <div class="product-price d-block py-5">
                                        <?php echo e(currencyFormat($cartItem["price"])); ?>

                                    </div>
                                    <div class="box-action">
                                        <div class="form-group-qty" data-id="<?php echo e($key); ?>">
                                            <a href="" class="btn-increase btn-change">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <input type="text" class="qty" value="1" disabled>
                                            <a href="" class="btn-decrease btn-change">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                        <a href="" data-id="<?php echo e($key); ?>" class="btn-delete"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="info-cart">
                        <div class="box-address round-5 bg-light fw-600">
                            <div class="box-flex d-flex fs-13">
                                <span>Giao Tới</span>
                                <a href="<?php echo e(route("user.address",["continue"=>route("cart")])); ?>" class="text-yellow">Thay đổi</a>
                            </div>
                            <div class="box-flex d-flex fs-13 fw-600">
                                <span class="fullname "><?php echo e($userAddress->fullname); ?></span>
                                <span><?php echo e($userAddress->phone); ?></span>
                            </div>
                            <p class="address fs-13">
                                <?php echo e($userAddress->address); ?>, <?php echo e($userAddress->commune_name); ?>, <?php echo e($userAddress->district_name); ?>, <?php echo e($userAddress->province_name); ?>

                            </p>
                        </div>  
                        <div class="box-total-price round-5 bg-light">
                            <div class="box-flex d-flex">
                                <span class="fs-13">Tạm Tính</span>
                                <span class="total-price-temporary fs-18"><?php echo e(currencyFormat($cartInfo["totalPrice"])); ?></span>
                            </div>

                            <div class="box-flex d-flex">
                                <span class="fs-13">Tổng Cộng</span>
                                <span class="total-price fs-18"><?php echo e(currencyFormat($cartInfo["totalPrice"])); ?></span>
                            </div>
                        </div>
                        <div class="box-btn text-center">
                            <a href="<?php echo e(route("cart.checkout")); ?>" class="btn w-100 fw-600 round-5 btn-yellow btn-buy-now">Mua Ngay</a>
                        </div>
                        <div class="box-btn-fix d-none p-10 shadow-sm bg-light w-100">
                            <div class="container d-flex">
                                <div class="box-left">
                                    <span class="fs-13">Tổng Cộng</span>
                                    <p class="total-price text-pink-weight"><?php echo e(currencyFormat($cartInfo["totalPrice"])); ?></p>
                                </div>
                                <div class="box-right">
                                    <a href="<?php echo e(route("cart.checkout")); ?>" class="btn btn-round btn-yellow">Mua Hàng 
                                        <small class="total">(<span class="total-qty"><?php echo e($cartInfo["totalQty"]); ?></span>)</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="box-empty-cart bg-light text-center round-5">
                    <a href="<?php echo e(route("home")); ?>" class="box-logo">
                        <img src="<?php echo e(asset("source/img/web/empty-cart.png")); ?>" class="logo w-100" alt="">
                    </a>
                    <p class="subtitle">Không Có Sản Phẩm Nào Trong Giỏ Hàng Của Bạn</p>
                    <a href="<?php echo e(route("home")); ?>" class="btn btn-yellow text-center round-5 fw-600">Tiếp Tục Mua Sắm</a>
                </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="text-center">
                    <p class="py-30">Vui Lòng Thêm Địa Chỉ Nhận Hàng Để Tiếp Tục!</p>
                    <a href="<?php echo e(route("user.address.add",["continue"=>route("cart")])); ?>" class="btn btn-yellow btn-round">Thêm Địa Chỉ</a>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/cart/index.blade.php ENDPATH**/ ?>