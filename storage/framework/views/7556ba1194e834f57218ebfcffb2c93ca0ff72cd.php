
<?php $__env->startSection("title","Trang Chủ Thành Đạt"); ?>
<?php $__env->startSection("js"); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<div id="box-slider">
    <div class="sliders">
        <div class="wp-sliders">
            <?php $__currentLoopData = $sliderBigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="slider-item">
                <a href="<?php echo e($slider->slider_link); ?>" class="slider-thumbnail">
                    <img 
                    src="<?php echo e(asset("source/img/web/slider_loading.png")); ?>" 
                    data-src="<?php echo e(asset($slider->slider_thumbnail)); ?>?time=<?php echo e(time()); ?>" class="thumbnail h-100 w-100 lazy">
                </a>
                <div class="lds-ring loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <nav class="navigate">
        <a href="" class="prev-slider"><i class="fas fa-arrow-left"></i></a>
        <a href="" class="next-slider"><i class="fas fa-arrow-right"></i></a>
    </nav>
</div>
<form id="hero-search" action="<?php echo e(route("product")); ?>">
    <div class="container">
        <h2 class="title">Xin Chào Quý Khách Bạn Muốn Gì?</h2>
        <div class="form-group form-group-append">
            <input type="text" name="search" class="form-hero-control">
            <button class="btn btn-search" ><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
<div id="content">
    <div class="container">
        <!-- Main Categrory -->
        <div id="main-category">
            <h3 class="title">Danh Mục Của Shop</h3>
            <ul id="categorys" class="overflow-scroll overflow-y-hidden">
                <?php $__currentLoopData = $mainCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="cat-item text-center col-xl-1 col-lg-2 col-md-2 col-sm-3 col-6">
                    <a href="<?php echo e(route("product",[$category->cat_slug,"cat_id"=>$category->cat_id])); ?>" class="cat-link box-thumbnail d-inline-block">
                        <img data-src="<?php echo e(asset($category->cat_thumbnail)); ?>"
                            class="thumbnail-cat w-100 lazy h-100" alt="">
                    </a>
                    <a href="" class="cat-link fs-13 d-block">
                        <?php echo e($category->cat_title); ?>

                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php $__currentLoopData = $catProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="box-product load-data load-product" data-cat="<?php echo e($cat->cat_id); ?>">
            <div class="top-cat">
                <h3 class="title"><?php echo e($cat->cat_title); ?></h3>
                <ul class="sub-cat">
                    <?php
                        $catChildrens=$cat->getChildrens();
                    ?>
                    <?php $__currentLoopData = $catChildrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catChildren): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="cat-item" data-cat="<?php echo e($catChildren->cat_id); ?>">
                            <div class="box">
                                <a href="javascript:void(0)" class="cat-thumbail d-inline-block">
                                    <img data-src="<?php echo e(asset($catChildren->cat_thumbnail)); ?>"
                                        class="thumbnail w-100 lazy" alt="<?php echo e($cat->cat_title); ?>">
                                </a>
                                <a href="javascript:void(0)" class="cat-title d-block"><?php echo e($catChildren->cat_title); ?></a>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="products mb-30">
                <!--Inser Dom-->
            </div>
            <div class="lds-ring loader loader-dark">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
            <?php if($key===0): ?>
            <!-- Slider Sub -->
            <div class="slider-sub">
                <?php $__currentLoopData = $sliderSmalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slider-item">
                    <a href="" class="slider-link round-5 overflow-hidden">
                        <img src="<?php echo e(asset($slider->slider_thumbnail)); ?>" class="slider-thumbnail w-100 h-100" alt="">
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $catPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="box-post load-data load-post py-50" data-cat="<?php echo e($catPost->cat_id); ?>">
            <div class="top-post">
                <h3 class="title"><?php echo e($catPost->cat_title); ?></h3>
                
            </div>
            <div class="posts mb-20">
                 <!--Inser Dom-->
            </div>
            <div class="lds-ring loader loader-dark">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/home/index.blade.php ENDPATH**/ ?>