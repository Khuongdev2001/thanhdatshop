<?php if(isset($productSeens[0])): ?>
<div class="box-product product-sliders product-seen">
    <h3 class="title">Sản Phẩm Đã Xem</h3>
    <div class="products">
        <?php $__currentLoopData = $productSeens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="product hot">
            <a href="" class="product-thumbnail d-block">
                <img src="<?php echo e(asset($product->url)); ?>" alt="<?php echo e($product->product_title); ?>" class="thumbnail w-100">
            </a>
            <p>
                <a href="" class="product-title d-block"><?php echo e($product->product_title); ?></a>
            </p>
            <div class="box-info">
                <div class="box-star">
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                </div>
                <span class="buyed">Đã Bán:14</span>
            </div>
            <div class="box-price">
                <span class="price"><?php echo e($product->price ? currencyFormat($product->price) : null); ?></span>
                <div class="box-discount">
                    <span class="num">-70%</span>
                </div>
            </div>
            <a href="" class="btn-add-card" data-id="<?php echo e($product->product_id); ?>">Thêm Giỏ Hàng</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/product/include/productSeen.blade.php ENDPATH**/ ?>