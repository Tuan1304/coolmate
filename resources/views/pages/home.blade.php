@extends('layout')
@section('content')
<!-- Sider -->
<section id="Slider">
    <div class="slider-items">
        <div class="slider-item">
            <img src="{{asset('imgs/baner1.webp')}}" alt="">
        </div>
        <div class="slider-item">
            <img src="{{asset('imgs/baner2.webp')}}" alt="">
        </div>
        <div class="slider-item">
            <img src="{{asset('imgs/baner3.webp')}}" alt="">
        </div>
    </div>
    <div class="slider-arrow">
        <i class="ri-arrow-right-line"></i>
        <i class="ri-arrow-left-line"></i> 
    </div>
</section>

<section class="hot-products">
    <div class="container">
        {{-- <i class="fas fa-arrow-left" style="text-align: center"></i> <!-- Mũi tên sang trái -->
        <i class="fas fa-arrow-right"></i> <!-- Mũi tên sang phải --> --}}
        <div class="row-grid-p">
            <p class="heading-text">Sản Phẩm hot</p>
        </div>   
        <div id="halim_related_product-2" class="owl-carousel" style="z-index: 0"> 
            @foreach ($hot_product->take(10) as $key => $pro)
            <div class="hot-product-item">
                <a href="{{route('product',$pro->slug)}}"><img src="{{asset('uploads/product/'.$pro->image)}}" alt=""></a>
                <span class="status">Hot</span> <!-- Thẻ <span> mới được thêm vào đây -->
                @if (!empty($pro->collection))
                    <a href="{{route('collection',$pro->collection->slug)}}" class="test-anh"><img src="{{asset('uploads/collection/icon/'.$pro->collection->icon)}}"></a>
                @endif
                <p><a href="{{route('product',$pro->slug)}}">{{$pro->title}}</a></p>
                <span>{{$pro->material}}</span>
                <div class="hot-product-item-price-home">
                    <p>{{number_format($pro->price)}}<sup>đ</sup></p>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Đoạn mã JavaScript -->
        <script>
            jQuery(document).ready(function($) {				
                var owl = $('#halim_related_product-2');
                owl.owlCarousel({
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    nav: true, // Hiển thị nút điều khiển
                    navText: ['<i class="fa-solid fa-angles-left"></i>', '<i class="fa-solid fa-angles-right"></i>'],
                    responsiveClass: true,
                    responsive: {
                        0: { items: 1 },
                        480: { items: 2 },
                        600: { items: 3 },
                        1000: { items: 5 }
                    }
                });
            });
        </script>

        <!-- Link JavaScript của Owl Carousel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <style>
            /* .hl-down-open {
                color: red;
            } */
        </style>
    
    </div>
    
</section>


<section class="hot-products">
    <div class="container">
    @foreach ($category_home->whereNotIn('id',[3]) as $key => $cate_home)
        <div class="row-grid-p"> 
            <p class="heading-text">{{$cate_home->title}}</p>
        </div>
        <div class="row-grid row-grid-hot-products">
            @foreach ($cate_home->product->where('status',1)->take(10) as $key => $pro)
            <div class="hot-product-item">
                <a href="{{route('product',$pro->slug)}}"><img src="{{asset('uploads/product/'.$pro->image)}}" alt=""></a>
                @if (!empty($pro->collection))
                    <a href="{{route('collection',$pro->collection->slug)}}" class="test-anh"><img src="{{asset('uploads/collection/icon/'.$pro->collection->icon)}}" style="z-index: 0"></a>
                @endif
                <p><a href="{{route('product',$pro->slug)}}">{{$pro->title}}</a></p>
                <span>{{$pro->material}}</span>
                <div class="hot-product-item-price-home">
                    <p>{{number_format($pro->price)}}<sup>đ</sup></p>
                </div>
                
            </div>
            @endforeach
        </div>
        {{-- <button class="xemthem-btn">Xem thêm</button> --}}
    @endforeach
    </div>
</section>

<section class="collection-products">
    <div class="container">
        <div class="row-grid-p">
            <p class="heading-text">Bộ sưu tập</p>
        </div>
        <div class="row-grid row-grid-collection-products">
            @foreach ($collection->take(3) as $key=>$coll)
            <div class="collection-product-item">
                <a href="{{route('collection',$coll->slug)}}"><img src="{{asset('uploads/collection/image/'.$coll->image)}}" alt=""></a>
                <p><a href="{{route('collection',$coll->slug)}}">{{$coll->title}}</a></p>
            </div>
            @endforeach
        </div> 
    </div>
</section>

<section class="new-products">
    <div class="container">
        <div class="row-grid-p">
            <p class="heading-text">Tin tức thời trang</p>
        </div>
        <div class="row-grid row-grid-new-products">
            <div class="new-product-item">
                <a href="https://routine.vn/tin-thoi-trang/top-phong-cach-thoi-trang-hot-2024"><img src="{{asset('imgs/top-phong-cach-thoi-trang-hot-2024.jpg')}}" alt=""></a>
                <p><a href="https://routine.vn/tin-thoi-trang/top-phong-cach-thoi-trang-hot-2024">Nắm bắt top xu hướng các phong cách thời trang hot năm 2024</a></p>
                <span>April 16, 2024</span>
                <h4 class="new-p">Xem ngay các phong cách thời trang đang được ưa chuộng và dẫn đầu xu hướng trong năm 2024 và m...</h4>
            </div>
            <div class="new-product-item">
                <a href="https://routine.vn/tin-thoi-trang/phoi-do-nam-han-quoc-mua-he-2024"><img src="{{asset('imgs/bi-quyet-phoi-do-nam-han-quoc2.jpg')}}" alt=""></a>
                <p><a href="https://routine.vn/tin-thoi-trang/phoi-do-nam-han-quoc-mua-he-2024">Bí quyết phối đồ style Hàn Quốc dành cho nam trong mùa hè 2024</a></p>
                <span>April 17, 2024</span>
                <h4 class="new-p">Khám phá cách phối đồ cho nam theo style Hàn Quốc mùa hè chuẩn soái ca để tạo nên phong cách độc đ...</h4>
            </div>
            <div class="new-product-item">
                <a href="https://routine.vn/tin-thoi-trang/cac-kieu-ao-so-mi-nu-han-quoc"><img src="{{asset('imgs/cac-kieu-ao-so-mi-nu-han-quoc.jpg')}}" alt=""></a>
                <p><a href="https://routine.vn/tin-thoi-trang/cac-kieu-ao-so-mi-nu-han-quoc">Gợi ý các kiểu áo sơ mi nữ Hàn Quốc mà nàng nên có trong tủ đồ</a></p>
                <span>April 19, 2024</span>
                <h4 class="new-p">Các kiểu áo sơ mi nữ Hàn Quốc không chỉ đơn thuần là một item thời trang mà còn là biểu tượng của s...</h4>
            </div>
        </div> 
        
    </div>
</section>

@endsection
