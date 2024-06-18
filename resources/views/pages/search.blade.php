@extends('layout')
@section('content')
<!-- Category  -->
<section class="category">
    <div class="container">
        <div class="category-top">
            <p>Tìm kiếm sản phẩm</p><span>&#47;</span><p style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">{{$search}}</p>
        </div>
    </div>
    <div class="container">
        <div class="row-flex"> 
            <div class="category-right-top">
                <div class="category-right-top row-flex">
                    <div class="category-right-top-filter">
                        <div class="filter-box" onclick="toggleMenu()">
                            <i class="fas fa-filter"></i>
                            <p class="filter-text">Bộ lọc</p>
                        </div>
                    </div>
                    <div class="menu-filter">
                        <p>Bộ Lọc</p>
                        <ul>
                            <li>Giới tính</li>
                            <li>Màu sắc</li>
                            <li>Chất liệu</li>
                        </ul>
                    </div>
                    <div class="category-right-top-title row-grid">
                        <p class="category-heading-text" style="font-size: 20px;">{{$total_products}} sản phẩm</p>
                    </div>
                    <div class="category-right-top-item">
                        <form action="" method="GET">
                        <select class="select-filter" name="" id="select-filter">
                            <option value="0">Sắp xếp theo</option>
                            <option value="gia=desc">Gía giảm dần</option>
                            <option value="gia=asc">Gía tăng dần</option>
                            <option value="view=desc">Được mua nhiều nhất</option>
                        </select>
                    </form>
                    </div>
                </div>
                <div class="category-right-top-content ">
                    <div class="row-grid row-grid-hot-products">
                        @foreach ($product as $key => $pro)
                        <div class="hot-product-item">
                            <a href="{{route('product',$pro->slug)}}"><img src="{{asset('uploads/product/'.$pro->image)}}" alt="" style="height: 350px"></a>
                            @if (!empty($pro->collection))
                                <a href="{{route('collection',$pro->collection->slug)}}" class="test-anh"><img src="{{asset('uploads/collection/icon/'.$pro->collection->icon)}}" style="z-index: 0"></a>
                            @endif
                            <a href="{{route('product',$pro->slug)}}"><div class="item"><p style="">{{$pro->title}}</p></div></a>
                            <span>{{$pro->material}}</span>
                            <div class="hot-product-item-price-home">
                                <p>{{number_format($pro->price)}}<sup>đ</sup></p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="paginationwrap">
            {{$product->links('pages.pagination.front')}}
        </div>
    </div>
    <script>
        function toggleMenu() {
            var menu = document.querySelector('.menu-filter');
            menu.classList.toggle('active');
        }

        // Thêm sự kiện lắng nghe click cho toàn bộ trang
        document.addEventListener('click', function(event) {
            var menu = document.querySelector('.menu-filter');
            var filterBox = document.querySelector('.filter-box');

            // Kiểm tra xem phần tử được nhấp vào có nằm trong thanh menu hoặc nút kích hoạt không
            var isClickedInsideMenu = menu.contains(event.target);
            var isClickedInsideFilterBox = filterBox.contains(event.target);

            // Nếu không phải là nút kích hoạt hoặc không phải là thanh menu và nút kích hoạt
            // thì ẩn thanh menu đi
            if (!isClickedInsideMenu && !isClickedInsideFilterBox) {
                menu.classList.remove('active');
            }
        });

        




    </script>
</section>
@endsection
