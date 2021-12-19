
<?php $__env->startSection("title","Thông Tin Địa Chỉ"); ?>
<?php $__env->startSection("content"); ?>
<div id="wp-content">
    <div id="content">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo e(route("home")); ?>" class="breadcrumb-item">
                    <span>Trang chủ</span>
                </a>
                <a href="" class="breadcrumb-icon">
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="" class="breadcrumb-item">
                    <span>Thông tin tài khoản</span>
                </a>
            </div>

            <h1 class="title fs-24 py-15">Số Địa Chỉ</h1>
            <div class="box-account-info">
                <div class="account-info account-address">
                    <a href="<?php echo e(setParamUrl(route("user.address.add"),"continue")); ?>" class="d-block box-btn-add bg-light mb-10">
                        <span class="icon fs-20"><i class="fas fa-plus"></i></span>
                        <span>Thêm Địa Chỉ</span>
                    </a>

                    <?php if(isset($userAddress[0])): ?>
                    <div class="list-address">
                        <?php $__currentLoopData = $userAddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="address-item d-flex mb-10 bg-light p-10" <?php echo e($address->is_default ? "is-default" : null); ?>>
                            <div class="address-info">
                                <h4 class="title">
                                    <span class="icon d-none">
                                        <i class="text-success far fa-check-circle"></i> 
                                    </span>
                                    <span class="fullname"><?php echo e($address->fullname); ?></span>
                                </h4>
                                <div class="address">
                                    <span class="text-dark-light">Địa Chỉ:</span>
                                    <?php echo e($address->address); ?>, <?php echo e($address->commune_name); ?>, <?php echo e($address->district_name); ?>, <?php echo e($address->province_name); ?>

                                </div>
                                <div class="phone">
                                    <span class="text-dark-light">SĐT:</span>
                                    <?php echo e($address->phone); ?>

                                </div>
                            </div>
                            <div class="address-action">
                                <a href="<?php echo e(setParamUrl(route("user.address.add",$address->id),"continue")); ?>" class="btn-edit fs-13 text-pink-weight">Chỉnh Sửa</a>
                                <?php if(!$address->is_default): ?>
                                <a href="javascript:void(0)" data-id="<?php echo e($address->id); ?>" class="btn-delete fs-13 text-primary pr-5">Xóa</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                        <div class="text-center">Hiện Chưa Có Địa Chỉ Giao Hàng</div>
                    <?php endif; ?>
                </div>
                <?php echo $__env->make("user.user.include.social", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Change Password -->
<div id="modal-change-password" class="modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <a href="" class="btn-exit"><i class="fas fa-times"></i></a>
        </div>
        <div class="modal-content d-flex align-items-normal">
            <div class="box-form">
                <h3 class="title">Thay Đổi Mật Khẩu<h3>
                    <form action="" id="form-change-password" >
                        <!-- password Form -->
                        <div class="mt-0 form-group form-group-outline group-password">
                            <label for="password">Mật Khẩu Mới</label>
                            <input type="password" id="password" data-field="password">
                            <span class="invalid-feedback"></span>
                            <span class="line"></span>
                        </div>
                        <!-- Password Confirm Form -->
                        <div class="form-group form-group-outline group-password_confirm">
                            <label for="password_confirm">Xác Nhận Mật Khẩu Mới</label>
                            <input type="password" id="password_confirm" data-field="password_confirm">
                            <span class="invalid-feedback"></span>
                            <span class="line"></span>
                        </div>
                        <div class="form-group-btn">
                            <button class="btn-full-round btn-change">Thay Đổi</button>
                        </div>
                    </form>
            </div>
            <div class="box-logo">
    
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/user/address/index.blade.php ENDPATH**/ ?>