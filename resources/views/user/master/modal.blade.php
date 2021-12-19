@guest
<!-- Modal Reg -->
<div id="modal-reg" class="modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <a href="" class="btn-exit"><i class="fas fa-times"></i></a>
        </div>
        <div class="modal-content d-flex align-items-normal">
            <div class="box-form">
                <a href="" class="navigation">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h3 class="title">Đăng Ký<h3>
                    <form action="" id="form-reg" method="POST">
                        <!-- Phone Form -->
                        <div class="form-group mb-0 form-group-outline group-phone">
                            <label for="phone">Nhập Số Điện Thoại</label>
                            <input type="text" id="phone" data-field="phone">
                            <span class="invalid-feedback"></span>
                            <span class="line"></span>
                        </div>
                        <!-- Password Form -->
                        <div class="form-group-2x">
                            <div class="form-group form-group-outline group-fullname">
                                <label for="fullname">Nhập Họ Và Tên</label>
                                <input type="fullname" id="fullname" data-field="fullname">
                                <span class="invalid-feedback"></span>
                                <span class="line"></span>
                            </div>
                            <div class="form-group form-group-outline group-email">
                                <label for="email">Nhập Email</label>
                                <input type="email" id="email" data-field="email">
                                <span class="invalid-feedback"></span>
                                <span class="line"></span>
                            </div>
                        </div>                        
                        <div class="form-group-2x">
                            <div class="form-group form-group-outline group-password">
                                <label for="password">Nhập Mật Khẩu</label>
                                <input type="password" id="password" data-field="password">
                                <span class="invalid-feedback"></span>
                                <span class="line"></span>
                            </div>
                            <div class="form-group form-group-outline group-password_confirm">
                                <label for="password_confirm">Xác Thực Mật Khẩu</label>
                                <input type="password" type="password_confirm" id="password_confirm" data-field="password_confirm">
                                <span class="invalid-feedback"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                        
                        <div class="form-group-btn">
                            <button class="btn-reg">Đăng Ký</button>
                        </div>
                    </form>
                    <div class="login-more">
                        <h4 class="title">Hoặc Tiếp Tục</h4>
                        <div class="socials">
                            <a href="{{route("user.login.social",1)}}" class="social-item">
                                <img src="{{asset("source/img/web/facebook.png")}}" alt="facebook">
                            </a>
                            <a href="{{route("user.login.social",2)}}" class="social-item">
                                <img src="{{asset("source/img/web/google.png")}}" alt="google">
                            </a>
                        </div>
                    </div>
            </div>
            <div class="box-logo"></div>
        </div>
    </div>
</div>
<!-- Modal Login -->
<div id="modal-login" class="modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <a href="" class="btn-exit"><i class="fas fa-times"></i></a>
        </div>
        <div class="modal-content d-flex align-items-normal">
            <div class="box-form">
                <a href="" class="navigation" data-toggle="modal" data-target="#modal-reg">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h3 class="title">Đăng Nhập<h3>
                    <form action="" id="form-login" >
                        <!-- Email Form -->
                        <div class="form-group form-group-outline group-email">
                            <label for="email">Email</label>
                            <input type="text" value="khuongdev2001@gmail.com" id="email" data-field="email">
                            <span class="invalid-feedback"></span>
                            <span class="line"></span>
                        </div>
                        <!-- Password Form -->
                        <div class="form-group form-group-outline group-password">
                            <label for="password">Mật Khẩu</label>
                            <input type="password" id="password" data-field="password">
                            <span class="invalid-feedback"></span>
                            <span class="line"></span>
                        </div>
                        <div class="form-group-btn">
                            <button class="btn-login">Đăng Nhập</button>
                        </div>
                    </form>
                    <div class="login-more">
                        <h4 class="title">Hoặc Tiếp Tục</h4>
                        <div class="socials">
                            <a href="{{route("user.login.social",1)}}" class="social-item">
                                <img src="{{asset("source/img/web/facebook.png")}}" alt="facebook">
                            </a>
                            <a href="{{route("user.login.social",2)}}" class="social-item">
                                <img src="{{asset("source/img/web/google.png")}}" alt="google">
                            </a>
                        </div>
                    </div>
            </div>
            <div class="box-logo">
    
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal active modal-confirm">
    <div class="modal-dialog round-5">
        <div class="modal-content">
            <div class="confirm">
                <p class="confirm-content">
                    Bạn muốn xoá sản phẩm này?
                </p>
                <div class="confirm-action">
                    <a href="" class="round-5 confirm-deny btn btn-outline-primary">Không</a>
                    <a href="" class="round-5 confirm-accpet btn text-light btn-pink">Xóa</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endguest