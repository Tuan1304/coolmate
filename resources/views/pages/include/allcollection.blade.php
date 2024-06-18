@extends('layout')
@section('content')
<!-- Category  -->
<section class="category">
    <div class="container">
        <div class="category-top">
            <p>Trang chủ</p><span>&#47;</span><p>Bộ sưu tập</p>
        </div>
    </div>
    <div class="container">
        <p style="text-align: center; padding-top: 20px;">Hệ thống thời trang coolmate trân trọng giới thiệu tới bạn những BST mới nhất của chúng tôi. Ngoài cảm hứng thiết kế thời trang theo từng mùa,
         coolmate còn tập trung khai thác những chất liệu mới nhằm mang tới trải nghiệm phong phú cho khách hàng.</p>
    </div>
    <div class="container">
        <div class="all-collection">
            <div class="collection small-collection">
                <!-- Bộ sưu tập nhỏ bên trái -->
                @foreach ($collection->take(3) as $key=>$coll)
                <div class="collection-left">
                    <a href="{{route('collection',$coll->slug)}}"><img src="{{asset('uploads/collection/image/'.$coll->image)}}" alt=""></a>
                </div>
                    {{-- <div class="collection-left">
                        <img src="imgs/4-resize.jpg" alt="">
                        <a href="{{route('collection',$coll->slug)}}"><img src="{{asset('uploads/collection/image/'.$coll->image)}}" alt=""></a>
                    </div>
                    <div class="collection-left">
                        <img src="imgs/Banner-web-1350x490-da-nen.jpg" alt="">
                    </div>
                    <div class="collection-left">
                        <img src="imgs/COVER-Ngang-09.jpg" alt="">
                    </div> --}}
                @endforeach
            </div>
            <div class="collection large-collection">
                <!-- Bộ sưu tập lớn -->
                <img src="imgs/360-STORY-9X16-2-Copy.jpg" alt="">
            </div>
            <div class="collection small-collection">
                <!-- Bộ sưu tập nhỏ bên phải -->
                @foreach ($collection->skip(3)->take(3) as $key=>$coll)
                <div class="collection-right">
                    <a href="{{route('collection',$coll->slug)}}"><img src="{{asset('uploads/collection/image/'.$coll->image)}}" alt=""></a>
                </div>
                {{-- <div class="collection-right">
                    <img src="imgs/Banner-web-595x363-1.png" alt="">
                </div>
                <div class="collection-right">
                    <img src="imgs/Biaf.jpg" alt="">
                </div>
                <div class="collection-right">
                    <img src="imgs/rsz_banner_web_1220x430.jpg" alt="">
                </div> --}}
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .all-collection {
            padding-top: 30px;
            display: grid;
            grid-template-columns: 5fr 4fr 5fr; 
            gap: 10px;
        }
        
        .collection {
            padding: 10px;
            
            cursor: pointer;
        }
        
        .collection img {
            padding: 5px 5px;
            max-width: 100%;
            height: auto;
        }
        
        .collection-small-middle {
            grid-column: 2;
        }
        
        .large-collection {
            display: flex;
            justify-content: center; 
        }

        .collection img:hover {
            transform: scale(1.1); /* Phóng to ảnh lên 110% khi trỏ chuột vào */
            transition: transform 0.4s ease; /* Thêm hiệu ứng chuyển động mượt mà */
        }

        /* Thêm đường viền và làm nổi bật ảnh khi trỏ chuột vào */
        .collection img:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Làm nổi bật ảnh với hiệu ứng bóng đổ */
        }
    </style>
</section>


@endsection
