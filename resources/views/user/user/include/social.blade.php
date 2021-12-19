<div class="tab-action-right bg-light">
    <div class="box-cart">
        <h2 class="title fw-600 fs-18 pb-10">Đơn Hàng</h2>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-chart-line"></i></span>
            <span class="title fs-13">Đơn Hàng Của Tôi</span>
            <a href="{{route("cart.history")}}" class="btn btn-yellow btn-sm btn-round">
                Đi Đến
            </a>
        </div>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-shopping-cart"></i></span>
            <span class="title fs-13">Giỏ Hàng</span>
            <a href="{{route("cart")}}" class="btn btn-yellow btn-sm btn-round">
                Đi Đến
            </a>
        </div>
    </div>
    <div class="box-address pt-30">
        <h2 class="title fw-600 fs-18 pb-10">Địa Chỉ</h2>
        <div class="box-flex">
            <span class="icon fs-24"><i class="fas fa-map-marker-alt"></i></span>
            <span class="title fs-13">Địa Chỉ Giao Hàng</span>
            <a href="{{route("user.address")}}" class="btn btn-yellow btn-sm btn-round">
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
        @foreach($socials as $social)
        <div class="social-item box-flex">
            <div class="d-flex">
                <a href="" class="{{$social->name}} box-thumbnail">
                    <img src="{{asset($social->image)}}" class="thumbnail w-100" alt="{{$social->name}}">
                </a>
                <span class="title fs-13 pl-15">{{$social->name}}</span>
            </div>
            @if($social->social_id)
            <a href="{{ $social->is_primary 
            ? "javascrip:void(0)"
            : route("user.account.connect",[
                $social->social_type_id,
                "remove"
            ])}}" class="btn btn-yellow btn-sm btn-round {{$social->is_primary ? "btn-brown-light" : null }} btn-unconnect">Đã Liên Kết</a>
            @else
            <a href="{{route("user.account.connect",[
                $social->social_type_id,
                "add"
            ])}}" class="btn btn-yellow btn-sm btn-round btn-connect">Liên Kết</a>
            @endif
        </div>
        @endforeach
    </div>
</div>