@extends("user.master.layout")
@section("title","Lịch Sử Mua Hàng")
@section("js")
@endsection
@section("content")
<div id="content">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{route("home")}}" class="breadcrumb-item">
                <span>Trang Chủ</span>
            </a>
            <a href="" class="breadcrumb-icon">
                <i class="fas fa-chevron-right"></i>
            </a>
            <a href="" class="breadcrumb-item">
                <span>Đơn Hàng Của Tôi</span>
            </a>
        </div>

        <div class="box-cart-info">
            <h3 class="title fs-24 pb-15">Thông Tin Đơn Hàng Của Tôi</h3>

            <div class="table-products bg-light fs-14 round-5">
                @if(isset($carts[0]))
                <table>
                    <thead>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Mua</th>
                        <th>Sản Phẩm</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                        <tr>
                            <td>
                                <a href="{{route("cart.order",$cart->cart_id)}}"
                                class="text-primary">{{$cart->code}}</a>
                            </td>
                            <td>{{$cart->created_at}}</td>
                            <td>
                                <span class="order-name">
                                    {{$cart->product_title}}
                                    {{ $cart->total_product>1 
                                    ? "...và còn {$cart->total_product} sản phẩm khác"
                                    :null 
                                    }}
                                </span>
                            </td>
                            <td>{{currencyFormat($cart->total_price)}}</td>
                            <td>{{[
                                "Chờ Xác Nhận",
                                "Đã Thanh Toán",
                                "Đang Vận Chuyển",
                                -1=>"Đã Hủy"
                            ][$cart->cart_status]}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center p-15">Không Có Dữ Liệu</p>
                @endif
            </div>
            <div class="table-products-mobile {{ $carts->hasMorePages() ? "load-data" : null }} d-none d-block-1024">
                @if(isset($carts[0]))
                <div class="table-head bg-light mb-10">
                    <nav class="order-types">
                        <a href="" class="nav-item btn-status active">Tất Cả</a>
                        @foreach($cartStatus as $index => $item)
                        <a href="" data-status="{{$index}}" class="nav-item btn-status">
                            {{$item}}
                        </a>
                        @endforeach
                    </nav>
                </div>
                <div class="table-body orders">             
                </div>
                @if($carts->hasMorePages())
                <div class="text-center">
                    <div class="lds-ring loader loader-dark">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                @endif
                @else
                <p class="bg-light p-15 mb-20">Không Có Dữ Liệu</p>
                @endif
            </div>
            <div class="box-paginate">
                {{$carts->links("user.paginate.index")}}
            </div>
        </div>
    </div>
</div>
@endsection