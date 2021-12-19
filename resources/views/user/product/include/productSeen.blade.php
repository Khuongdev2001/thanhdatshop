@if(isset($productSeens[0]))
<div class="box-product product-sliders product-seen">
    <h3 class="title">Sản Phẩm Đã Xem</h3>
    <div class="products">
        @foreach($productSeens as $product)
        <div class="product hot">
            <a href="" class="product-thumbnail d-block">
                <img src="{{asset($product->url)}}" alt="{{$product->product_title}}" class="thumbnail w-100">
            </a>
            <p>
                <a href="" class="product-title d-block">{{$product->product_title}}</a>
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
                <span class="price">{{$product->price ? currencyFormat($product->price) : null}}</span>
                <div class="box-discount">
                    <span class="num">-70%</span>
                </div>
            </div>
            <a href="" class="btn-add-card" data-id="{{$product->product_id}}">Thêm Giỏ Hàng</a>
        </div>
        @endforeach
    </div>
</div>
@endif