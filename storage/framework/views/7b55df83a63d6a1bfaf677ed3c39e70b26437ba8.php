<div class="tab-action-right bg-light">
    <div class="box-cart">
        <h2 class="title fw-600 fs-18 pb-10">Đơn Hàng</h2>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-chart-line"></i></span>
            <span class="title fs-13">Đơn Hàng Của Tôi</span>
            <a href="<?php echo e(route("cart.history")); ?>" class="btn btn-yellow btn-sm btn-round">
                Đi Đến
            </a>
        </div>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-shopping-cart"></i></span>
            <span class="title fs-13">Giỏ Hàng</span>
            <a href="<?php echo e(route("cart")); ?>" class="btn btn-yellow btn-sm btn-round">
                Đi Đến
            </a>
        </div>
    </div>
    <div class="box-address pt-30">
        <h2 class="title fw-600 fs-18 pb-10">Địa Chỉ</h2>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-map-marker-alt"></i></span>
            <span class="title fs-13">Địa Chỉ Giao Hàng</span>
            <a href="<?php echo e(route("user.address")); ?>" class="btn btn-yellow btn-sm btn-round">
                Đi Đến
            </a>
        </div>
    </div>
    <div class="box-security py-30">
        <h2 class="title fw-600 fs-18 pb-10">Bảo Mật</h2>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-shield-alt"></i></span>
            <span class="title fs-13">Đổi Mật Khẩu</span>
            <a href="" class="btn btn-yellow btn-sm btn-round btn-change-password" 
            data-toggle="modal" data-target="#modal-change-password">Cập Nhật</a>
        </div>
    </div>
    <div class="box-socials">
        <h2 class="title fw-600 fs-18 pb-10">Liên Kết Tài Khoản</h2>
        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="social-item box-flex">
            <div class="d-flex">
                <a href="" class="<?php echo e($social->name); ?> box-thumbnail">
                    <img src="<?php echo e(asset($social->image)); ?>" class="thumbnail w-100" alt="<?php echo e($social->name); ?>">
                </a>
                <span class="title fs-13 pl-15"><?php echo e($social->name); ?></span>
            </div>
            <?php if($social->social_id): ?>
            <a href="<?php echo e($social->is_primary 
            ? "javascrip:void(0)"
            : route("user.account.connect",[
                $social->social_type_id,
                "remove"
            ])); ?>" class="btn btn-yellow btn-sm btn-round <?php echo e($social->is_primary ? "btn-brown-light" : null); ?> btn-unconnect">Đã Liên Kết</a>
            <?php else: ?>
            <a href="<?php echo e(route("user.account.connect",[
                $social->social_type_id,
                "add"
            ])); ?>" class="btn btn-yellow btn-sm btn-round btn-connect">Liên Kết</a>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/user/include/social.blade.php ENDPATH**/ ?>