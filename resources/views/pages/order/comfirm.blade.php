@extends('layout')
@section('content')
<!-- cart -->
<section class="order-confirm p-to-top">
    <div class="container">
        <div class="row-grid">
            <p style="font-weight: lighter;" class="heading-text-p">Xác nhận đơn hàng: <span style="font-weight: bolder; font-size: larger;">{{$order->name}}</span></p>
        </div>
        <div class="row-flex">
            <div class="order-confirm-content">
                <p>Đơn hàng đã được gửi <span style="font-weight: bolder;">Thành công</span>! <br>
                    <span style="font-size: small;">Vui lòng check<a href="https://mail.google.com/" style="font-weight: bolder; font-size: larger; font-style: italic;"> Email </a>đã đăng ký để xác nhận</span> <br> 
                    <span style="font-size: small;">Hệ thống sẽ tự hủy đơn hàng trong vòng 2h nếu bạn không xác nhận đơn hàng</span>
                </p>
                <button style="margin-top: 15px;" class="main-btn"><a href="{{route('homepage')}}">Tiếp tục mua hàng</a></button>
            </div>
        </div>
    </div>
</section>

<!-- Relate Product -->
<section class="hot-products" style="padding-top: 12px">
    <div class="container">
        <div class="row-grid">
            <p class="heading-text-pro">Có thể bạn muốn mua</p>
        </div>
        <div class="row-grid row-grid-hot-products">
            @foreach ($related->take(5) as $key => $pro)
            <div class="hot-product-item">
                <a href="{{route('product',$pro->slug)}}"><img src="{{asset('uploads/product/'.$pro->image)}}" alt=""></a>
                <p><a href="{{route('product',$pro->slug)}}">{{$pro->title}}</a></p>
                <span>{{$pro->material}}</span>
                <div class="hot-product-item-price-home">
                    <p>{{number_format($pro->price)}}<sup>đ</sup>  <span>100,000</span><sup class="price">đ</sup></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script src="{{asset('js/apiprovince.js')}}"></script>
@endsection