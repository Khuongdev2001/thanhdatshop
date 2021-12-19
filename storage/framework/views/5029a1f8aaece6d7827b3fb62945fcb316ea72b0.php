
<?php $__env->startSection("title","Danh Sách Sản Phẩm"); ?>
<?php $__env->startSection("js"); ?>
<!-- Module Product -->
<script src="<?php echo e(asset("source/js/module/product.js")); ?>"></script>
<!-- Module Comment -->
<script src="<?php echo e(asset("source/js/module/comment.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<div id="content">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?php echo e(route("home")); ?>" class="breadcrumb-item">
                <span>Trang Chủ</span>
            </a>
            <a href="<?php echo e(route("product",[$product->cat_slug,"cat_id"=>$product->cat_id])); ?>" class="breadcrumb-icon">
                <i class="fas fa-chevron-right"></i>
            </a>
            <a href="<?php echo e(route("product",[$product->cat_slug,"cat_id"=>$product->cat_id])); ?>"
                class="breadcrumb-item">
                <span><?php echo e($product->cat_title); ?></span>
            </a>
            <a href="javascript:void(0)" class="breadcrumb-icon">
                <i class="fas fa-chevron-right"></i>
            </a>
            <a href="javascript:void(0)" class="breadcrumb-item">
                <span>Thuốc Liệu Tóc</span>
            </a>
        </div>
        <div id="box-product-details">
            <div class="product-slider">
                <div class="slider-preview">
                    <a href="" class="box-thumbnail d-block img-ratio">
                        <img src="<?php echo e(asset("source/img/web/slider.webp")); ?>"
                        alt="<?php echo e($product->product_title); ?>" class="thumbnail w-100">
                    </a>
                </div>
                <ul class="slider-paginate overflow-scroll">
                    <?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="slider-item">
                        <div class="slider-link <?php echo e($key ?: "active"); ?> img-ratio">
                            <img src="<?php echo e($image->src); ?>" 
                            alt="<?php echo e($product->product_title); ?>" class="slider-thumbnail w-100">
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="product-info">
                <h1 class="title"><?php echo e($product->product_title); ?></h1>
                <div class="product-group-2x">
                    <div class="box-left">
                        <div class="box-price text-center">
                            <p class="price fs-36">
                                <?php echo e($product->price 
                                    ? currencyFormat($product->price) 
                                    :null); ?>

                            </p>
                            <p class="price-old fs-13">
                                <?php echo e($product->price_old 
                                    ? currencyFormat($product->price_old) 
                                    :null); ?>

                            </p>

                        </div>
                        <ul id="contents">
                            <?php echo $product->product_description; ?>

                        </ul>
                        <div class="box-qty">
                            <span class="title">Số Lượng:</span>
                            <div class="form-group-qty" data-id="<?php echo e($product->product_id); ?>">
                                <a href="" class="btn-increase">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <input type="text" class="qty" value="1">
                                <a href="" class="btn-decrease">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="" class="btn-add-card btn-not-sm btn btn-yellow btn-round" data-id="<?php echo e($product->product_id); ?>">
                                Thêm Giỏ Hàng
                            </a>
                            <a href="" class="btn-buy-now btn-not-sm btn btn-outline-yellow btn-round">Mua Ngay</a>
                        </div>
                        <div class="socials">
                            <h4 class="title">Chia sẻ:</h4>
                            <a href="" class="social">
                                <img data-src="<?php echo e(asset("source/img/web/facebook.png")); ?>"
                                alt="<?php echo e($product->product_title); ?>" class="social-img w-100 lazy">
                            </a>
                            <a href="" class="social">
                                <img data-src="<?php echo e(asset("source/img/web/facebook.png")); ?>"
                                alt="<?php echo e($product->product_title); ?>" class="social-img w-100 lazy">
                            </a>
                            <a href="" class="social">
                                <img data-src="<?php echo e(asset("source/img/web/google.png")); ?>"
                                alt="<?php echo e($product->product_title); ?>" class="social-img w-100 lazy">
                            </a>
                        </div>
                    </div>

                    <div class="box-policy">
                        <h3 class="title text-center">CHÍNH SÁCH CỬA HÀNG</h3>
                        <ul id="policys" class="fs-13">
                            <li class="policy">
                                <a href="" class="policy-title">
                                    Bảo Hành
                                </a>
                                <span class="policy-content fw-600">12 tháng</span>
                            </li>
                            <li class="policy">
                                <a href="" class="policy-title">
                                    Bảo Hành
                                </a>
                                <span class="policy-content fw-600">12 tháng</span>
                            </li>
                            <li class="policy">
                                <a href="" class="policy-title">
                                    Bảo Hành
                                </a>
                                <span class="policy-content fw-600">12 tháng</span>
                            </li>
                        </ul>
                        <ul id="policy-icons" class="text-center fs-10">
                            <li class="policy-item">
                                <a href="" class="box-thumbnail d-inline-block">
                                    <img src="<?php echo e(asset("source/img/web/check.png")); ?>" alt="chính sách" class="w-100">
                                </a>
                                <span class="d-block">
                                    Bảo Hành
                                </span>
                            </li>

                            <li class="policy-item">
                                <a href="" class="box-thumbnail d-inline-block">
                                    <img src="<?php echo e(asset("source/img/web/check.png")); ?>" alt="chính sách" class="w-100">
                                </a>
                                <span class="d-block">
                                    Bảo Hành
                                </span>
                            </li>

                            <li class="policy-item">
                                <a href="" class="box-thumbnail d-inline-block">
                                    <img src="<?php echo e(asset("source/img/web/check.png")); ?>" alt="chính sách" class="w-100">
                                </a>
                                <span class="d-block">
                                    Bảo Hành
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($productSames[0])): ?>
        <div class="box-product product-sliders">
            <h3 class="title">Sản Phẩm Tương Tự <?php echo e($product->product_title); ?></h3>
            <div class="products">
                <?php $__currentLoopData = $productSames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productSame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product">
                    <a href="" class="img-ratio product-thumbnail d-block">
                        <img data-src="<?php echo e(asset($productSame->url)); ?>" 
                        alt="<?php echo e($productSame->product_title); ?>" class="thumbnail lazy w-100">
                    </a>
                    <p>
                        <a href="" class="product-title d-block"><?php echo e($productSame->product_title); ?></a>
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
                        <span class="price"><?php echo e($productSame->price_old 
                            ? currencyFormat($productSame->price_old) 
                            :null); ?></span>
                        <div class="box-discount">
                            <span class="num">-70%</span>
                        </div>
                    </div>
                    <a href="" class="btn-add-card" data-id="<?php echo e($product->product_id); ?>">Thêm Giỏ Hàng</a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
        <div id="product-tab">
            <div class="tab-action">
                <a href="" class="tab-item tab-details-product btn btn-round">Chi Tiết Sản Phẩm</a>
                <a href="" class="tab-item tab-comment-product btn btn-round active">Đánh Giá Sản Phẩm</a>
            </div>
            <div id="details-product" class="tab-penal">
                <div>
                    <?php if(!$product->product_content): ?>
                    <div class="bg-yellow my-30 p-20 round-5 text-center">
                        Chưa Cập Nhật
                    </div>
                    <?php endif; ?>
                    <?php echo $product->product_content; ?>

                </div>
            </div>
            <div id="comment-product" data-module="product" data-id="<?php echo e($product->product_id); ?>" class="tab-penal active box-comment">
                <form class="px-20">
                    <div class="form-group my-20 form-group-outline">
                        <label for="comment_content">Nội Dung Bình Luận</label>
                        <input type="text" id="comment_content" class="form-control" data-field="comment_content">
                        <span class="invalid-feedback"></span>
                        <div class="line"></div>
                        <a href="" class="btn-add"><i class="fas fa-paper-plane"></i></a>
                    </div>
                </form>
                <div class="wp-comment">
                    
                </div>
            </div>
        </div>
        <?php echo $__env->make("user.product.include.productSeen", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/product/details.blade.php ENDPATH**/ ?>