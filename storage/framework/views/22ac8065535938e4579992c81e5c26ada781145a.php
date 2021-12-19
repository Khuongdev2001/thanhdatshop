<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make("user.master.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="dark">
    <div id="wrapper">
        <header>
            <div class="container">
                <nav id="nav">
                    <a href="<?php echo e(route("home")); ?>" class="d-block" id="main-logo">
                        <img src="<?php echo e(asset("source/img/web/logo.jpg")); ?>" class="logo w-100" alt="logo thành đạt">
                    </a>
                    <ul id="main-menu">
                        <?php echo $__env->make("user.master.menu",["menus"=>$menus,"parent_id"=>0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </ul>
                    <!-- Menu Mobile !-->
                    <div id="box-menu-mobile" class="d-none">
                        <div class="box-overflow">
                            <div class="box-btn">
                                <a href="" class="btn-exit"><i class="fas fa-times"></i></a>
                            </div>
                            <a href="<?php echo e(route("home")); ?>" class="d-block" id="main-logo">
                                <img src="<?php echo e(asset("source/img/web/logo.jpg")); ?>" class="logo w-100" alt="logo thành đạt">
                            </a>
                            <ul id="main-menu-mobile">
                                <?php echo $__env->make("user.master.menuMobile",["menuMobiles"=>$menuMobiles,"parent_id"=>0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="heade-auth">
                    <?php if(auth()->guard()->check()): ?>
                    <div class="dropdown is-login">
                        <a href="" class="box-thumbnail" data-toggle="dropdown">
                            <?php if($userLogin->avatar): ?>
                                <img data-src="<?php echo e(asset($userLogin->avatar)); ?>" class="w-100 thumbnail lazy d-block" alt="">
                            <?php elseif($userLogin->avatar_cdn): ?>
                                <img data-src="<?php echo e($userLogin->avatar_cdn); ?>" class="w-100 thumbnail lazy d-block" alt="">      
                            <?php else: ?>
                            <span class="w-100 thumbnail d-block"></span>                            
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu">
                            <div class="top">
                                <i class="fas fa-caret-up"></i>
                            </div>
                            <div class="dropdown-item">
                                <a href="<?php echo e(route("cart.history")); ?>" class="dropdown-link">
                                    <span class="title"><i class="fas fa-chart-line"></i></span>
                                    <span class="content">Đơn Hàng Của Tôi</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="<?php echo e(route("user.address")); ?>" class="dropdown-link">
                                    <span class="title"><i class="fas fa-map-marker-alt"></i></span>
                                    <span class="content">DS Địa Chỉ</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="<?php echo e(route("user.account")); ?>" class="dropdown-link">
                                    <span class="title"><i class="fas fa-user"></i></span>
                                    <span class="content"><?php echo e($userLogin->fullname); ?></span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="<?php echo e(route("logout")); ?>" class="dropdown-link">
                                    <span class="title"><i class="fas fa-sign-out-alt"></i></span>
                                    <span class="content fs-1">Đăng Xuất</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                    <a href="" class="btn-login btn btn-yellow btn-round" data-toggle="modal" data-target="#modal-login">Đăng Nhập</a>   
                    <?php endif; ?>
                    <a href="<?php echo e(route("cart")); ?>" class="box-cart">
                        <span class="cart-icon">
                            <span class="cart-num"><?php echo e(session("cart.cartInfo.totalQty",0)); ?></span>
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <span class="cart-title">Giỏ Hàng</span>
                    </a>
                    <a href="" class="btn-mode"><i class="fas fa-moon"></i></a>
                    <a href="" class="btn-open-menu-mobile"><i class="fas fa-bars"></i></a>
                </div>
            </div>
        </header>
        <div id="wp-content">
            <?php echo $__env->yieldContent("content"); ?>
        </div>
        <?php echo $__env->make("user.master.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php echo $__env->make("user.master.modal", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
    <!-- defind router Js
		============================================ -->
        <script src="<?php echo e(asset("source/js/router.js")); ?>"></script>
    <!-- defind function Js
		============================================ -->
        <script src="<?php echo e(asset("source/js/function.js")); ?>"></script>
    <!-- app Js
		============================================ -->
    <script src="<?php echo e(asset("source/js/app.js")); ?>"></script>
    <script>
        /* Start Notification Js*/
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                Toastr({ type:"error", title:"Error", message:"<?php echo e($error); ?>"})
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(session("success")): ?>
            Toastr({ type:"success", title:"Success", message:"<?php echo e(session('success')); ?>"})
        <?php endif; ?>
    </script>
    <?php echo $__env->yieldContent("js"); ?>
</html><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/master/layout.blade.php ENDPATH**/ ?>