@extends("user.master.layout")
@section("title","Thông Tin Tài Khoản")
@section("content")
<div id="wp-content">
    <div id="content">
        <div class="container">
            <div class="breadcrumb">
                <a href="" class="breadcrumb-item">
                    <span>Trang chủ</span>
                </a>
                <a href="" class="breadcrumb-icon">
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="" class="breadcrumb-item">
                    <span>Thông tin tài khoản</span>
                </a>
            </div>

            <h1 class="title fs-24 py-15">Thông Tin Tài Khoản</h1>
            <div class="box-account-info mb-30">
                <div class="account-info bg-light">
                    <h2 class="title fw-600 fs-18">Thông Tin Cá Nhân</h2>
                    <form action="" id="form-update-account">
                        <div class="form-group my-20 form-group-outline">
                            <label for="fullname">Họ Và Tên</label>
                            <input type="text" id="fullname" class="form-control" value="{{$userLogin->fullname}}" data-field="fullname">
                            <span class="invalid-feedback"></span>
                            <div class="line"></div>
                        </div>
                        <div class="form-group-2x">
                            <div class="form-group my-20 form-group-outline">
                                <label for="phone">SĐT</label>
                                <input type="text" id="phone" class="form-control" value="{{$userLogin->phone}}" data-field="phone">
                                <span class="invalid-feedback"></span>
                                <div class="line"></div>
                            </div>
                            <div class="form-group my-20 form-group-outline">
                                <label for="email">Email</label>
                                <input type="text" id="email" class="form-control" value="{{$userLogin->email}}" data-field="email">
                                <span class="invalid-feedback"></span>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-yellow btn-round btn-update">Lưu Thay Đổi</button>
                        </div>
                    </form>
                </div>
                @include("user.user.include.social")
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
@endsection