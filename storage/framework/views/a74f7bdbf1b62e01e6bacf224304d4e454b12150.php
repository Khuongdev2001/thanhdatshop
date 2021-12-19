
<?php $__env->startSection('title', 'Thêm Địa Chỉ'); ?>
<?php $__env->startSection('content'); ?>
    <div id="wp-content">
        <div id="content">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo e(route("home")); ?>" class="breadcrumb-item">
                        <span>Trang chủ</span>
                    </a>
                    <a href="javascript:void(0)" class="breadcrumb-icon">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="javascript:void(0)" class="breadcrumb-item">
                        <span>Tạo Sổ Địa Chỉ</span>
                    </a>
                </div>

                <h1 class="title fs-24 py-15">Tạo Sổ Địa Chỉ</h1>
                <div class="box-account-info mb-30">
                    <div class="account-info bg-light">
                        <h2 class="title fw-600 fs-18">Thông Tin Cá Nhân</h2>
                        <form action="<?php echo e(empty($userAddress) 
                            ? setParamUrl(route("user.address.add"),"continue") 
                            :setParamUrl(route("user.address.update",$userAddress->id),"continue")); ?>" method="POST" id="form-add-address">
                            <?php echo csrf_field(); ?>
                            <div class="form-group-2x">
                                <div class="form-group my-20 form-group-outline">
                                    <label for="fullname">Họ Và Tên</label>
                                    <input type="text" id="fullname" class="form-control"
                                        value="<?php echo e($userAddress->fullname ?? $userLogin->fullname); ?>" name="fullname">
                                    <span class="invalid-feedback"></span>
                                    <div class="line"></div>
                                </div>
                                <div class="form-group my-20 form-group-outline">
                                    <label for="company">Công Ty: </label>
                                    <input type="text" id="company" class="form-control" value="<?php echo e($userAddress->company ?? null); ?>"
                                        name="company">
                                    <span class="invalid-feedback"></span>
                                    <div class="line"></div>
                                </div>
                            </div>
                            <div class="form-group my-20 form-group-outline">
                                <label for="phone">SĐT</label>
                                <input type="text" id="phone" class="form-control" value="<?php echo e($userAddress->phone ?? $userLogin->phone); ?>"
                                    name="phone">
                                <span class="invalid-feedback"></span>
                                <div class="line"></div>
                            </div>
                            <div class="form-group-2x">
                                <div class="form-group my-20">
                                    <label for="province_id" class="pb-15 d-block postion-unset">Chọn Tỉnh/Tp</label>
                                    <select name="province_id" id="province" class="form-select-control w-100 round-5">
                                        <option value="<?php echo e($userAddress->province_id ?? null); ?>"></option>
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="form-group my-20">
                                    <label for="district_id" class="pb-15 d-block postion-unset">Chọn Quận/Huyện</label>
                                    <select name="district_id" id="district" class="form-select-control w-100 round-5">
                                        <option value="<?php echo e($userAddress->district_id ?? null); ?>"></option>
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group my-20">
                                <label for="commune_id" class="pb-15 d-block postion-unset">Chọn Phường/Xã</label>
                                <select name="commune_id" id="commune" class="form-select-control w-100 round-5">
                                    <option value="<?php echo e($userAddress->commune_id ?? null); ?>"></option>
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="form-group my-20 form-group-outline">
                                <label for="address">Địa Chỉ</label>
                                <input type="text" id="address" class="form-control" value="<?php echo e($userAddress->address ?? null); ?>"
                                    name="address">
                                <span class="invalid-feedback"></span>
                                <div class="line"></div>
                            </div>
                            <?php if($checkAddress && empty($userAddress["is_default"])): ?>
                            <div class="form-group form-group-hero input-style">
                                <input type="checkbox" class="form-check-control" name="is_default" <?php echo e(empty($userAddress["is_default"]) 
                                ? null 
                                : "checked"); ?> value="1" id="is_default">
                                <label class="checkbox" for="is_default"></label>
                                <label class="price pl-10" for="is_default">Đặt Làm Mặt Định</label>
                            </div>
                            <?php endif; ?>
                            <div class="form-group text-center">
                                <button class="btn btn-yellow btn-round btn-update">Lưu Thay Đổi</button>
                            </div>
                        </form>
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
                            <form action="" id="form-change-password">
                                <!-- password Form -->
                                <div class="mt-0 form-group form-group-outline group-password">
                                    <label for="password">Mật Khẩu Mới</label>
                                    <input type="password" id="password" name="password">
                                    <span class="invalid-feedback"></span>
                                    <span class="line"></span>
                                </div>
                                <!-- Password Confirm Form -->
                                <div class="form-group form-group-outline group-password_confirm">
                                    <label for="password_confirm">Xác Nhận Mật Khẩu Mới</label>
                                    <input type="password" id="password_confirm" name="password_confirm">
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

<?php echo $__env->make("user.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/user/address/add.blade.php ENDPATH**/ ?>