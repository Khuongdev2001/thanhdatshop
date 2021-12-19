
<?php $__env->startSection("title","Lịch Sử Mua Hàng"); ?>
<?php $__env->startSection("js"); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<div id="content">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?php echo e(route("home")); ?>" class="breadcrumb-item">
                <span>Trang Chủ</span>
            </a>
            <a href="" class="breadcrumb-icon">
                <i class="fas fa-chevron-right"></i>
            </a>
            <a href="" class="breadcrumb-item">
                <span>Đơn Hàng Của Tôi</span>
            </a>
        </div>

        <div class="box-cart-info">
            <h3 class="title fs-24 pb-15">Thông Tin Đơn Hàng Của Tôi</h3>

            <div class="table-products bg-light fs-14 round-5">
                <?php if(isset($carts[0])): ?>
                <table>
                    <thead>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Mua</th>
                        <th>Sản Phẩm</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route("cart.order",$cart->cart_id)); ?>"
                                class="text-primary"><?php echo e($cart->code); ?></a>
                            </td>
                            <td><?php echo e($cart->created_at); ?></td>
                            <td>
                                <span class="order-name">
                                    <?php echo e($cart->product_title); ?>

                                    <?php echo e($cart->total_product>1 
                                    ? "...và còn {$cart->total_product} sản phẩm khác"
                                    :null); ?>

                                </span>
                            </td>
                            <td><?php echo e(currencyFormat($cart->total_price)); ?></td>
                            <td><?php echo e([
                                "Chờ Xác Nhận",
                                "Đã Thanh Toán",
                                "Đang Vận Chuyển",
                                -1=>"Đã Hủy"
                            ][$cart->cart_status]); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-center p-15">Không Có Dữ Liệu</p>
                <?php endif; ?>
            </div>
            <div class="table-products-mobile <?php echo e($carts->hasMorePages() ? "load-data" : null); ?> d-none d-block-1024">
                <?php if(isset($carts[0])): ?>
                <div class="table-head bg-light mb-10">
                    <nav class="order-types">
                        <a href="" class="nav-item btn-status active">Tất Cả</a>
                        <?php $__currentLoopData = $cartStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="" data-status="<?php echo e($index); ?>" class="nav-item btn-status">
                            <?php echo e($item); ?>

                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </nav>
                </div>
                <div class="table-body orders">             
                </div>
                <?php if($carts->hasMorePages()): ?>
                <div class="text-center">
                    <div class="lds-ring loader loader-dark">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <p class="bg-light p-15 mb-20">Không Có Dữ Liệu</p>
                <?php endif; ?>
            </div>
            <div class="box-paginate">
                <?php echo e($carts->links("user.paginate.index")); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/cart/history.blade.php ENDPATH**/ ?>