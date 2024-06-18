@extends('layout')
@section('content')
<!-- Category  -->
<section class="category">
    <div class="container">
        <div class="category-top">
            <p>Trang chủ</p><span>&#47;</span><p>{{$cate_slug->title}}</p>
        </div>
    </div>
    <div class="container">
        <div class="category-top-img">
            <img src="{{asset('imgs/spmoi.jpg')}}" alt="">
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
                    <form action="{{route('category',$cate_slug->slug)}}" method="GET">
                        @csrf
                        <div class="menu-filter">
                            <p>Bộ Lọc</p>
                            <ul>
                                <li><a href=""><i class="ri-file-list-line"></i>Sắp xếp<i class="ri-add-box-line"></i></a>
                                    <ul class="sub-menu-filter">
                                        <div class="sub-menu-item">
                                            <label><input type="radio" name="order" value="name_a_z"> Tên</label>
                                            <label><input type="radio" name="order" value="date"> Ngày đăng</label>
                                            <label><input type="radio" name="order" value="watch_views"> Lượt xem</label>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href=""><i class="ri-file-list-line"></i>Nam<i class="ri-add-box-line"></i></a>
                                    <ul class="sub-menu-filter">
                                        <div class="sub-menu-item">
                                            @foreach ($man as $key=>$man)
                                                <label><input type="radio" name="man" value="{{$man->id}}"> {{$man->title}}</label>
                                                {{-- <option value="{{$man->id}}">{{$man->title}}</option> --}}
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>
                                <li><a href=""><i class="ri-file-list-line"></i>Nữ<i class="ri-add-box-line"></i></a>
                                    <ul class="sub-menu-filter">
                                        <div class="sub-menu-item">
                                            @foreach ($women as $key=>$wom)
                                                <label><input type="radio" name="women" value="{{$wom->id}}"> {{$wom->title}}</label>
                                                {{-- <option value="{{$wom->id}}">{{$wom->title}}</option> --}}
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="ri-file-list-line"></i>Màu sắc<i class="ri-add-box-line"></i>
                                    </a>
                                    <ul class="sub-menu-filter">
                                        <div class="sub-menu-item">
                                            @php
                                                $colors = [];
                                            @endphp
                                            @foreach ($all_products as $pro)
                                                @if (!in_array($pro->color, $colors))
                                                    <label><input type="radio" name="color" value="{{$pro->color}}"> 
                                                    @if ($pro->color==0)
                                                        Đỏ
                                                    @elseif($pro->color==1)
                                                        Trắng
                                                    @elseif($pro->color==2)
                                                        Đen
                                                    @elseif($pro->color==3)
                                                        Xanh Lam
                                                    @elseif($pro->color==4)
                                                        Xanh Lá
                                                    @elseif($pro->color==5)
                                                        Be
                                                    @elseif($pro->color==6)
                                                        Nâu
                                                    @endif</label>
                                                    {{-- <option value="{{$pro->color}}">{{$pro->color}}</option> --}}
                                                    @php
                                                        $colors[] = $pro->color;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>                                
                                <li><a href=""><i class="ri-file-list-line"></i>Chất liệu<i class="ri-add-box-line"></i></a>
                                    <ul class="sub-menu-filter">
                                        <div class="sub-menu-item">
                                            @php
                                                $materials = [];
                                            @endphp
                                            @foreach ($all_products as $key => $pro)
                                            @if (!in_array($pro->material, $materials))
                                            <label><input type="radio" name="material" value="{{$pro->material}}"> {{$pro->material}}</label>
                                                {{-- <option value="{{$pro->material}}">{{$pro->material}}</option> --}}
                                                @php
                                                    $materials[] = $pro->material;
                                                @endphp
                                            @endif
                                        @endforeach
                                        </div>
                                    </ul>
                                </li>
                                <input type="submit" name="locsanpham" class="btn main-btn" value="Lọc sản phẩm">
                            </ul>
                        </div>
                    </form>
                    <div class="category-right-top-title row-grid">
                        <p class="category-heading-text" style="font-size: 20px;">{{$total_products}} sản phẩm</p>
                    </div>
                    <div class="category-right-top-item">
                        <form action="{{route('category',$cate_slug->slug)}}" method="GET">
                        <select class="select-filter" name="" id="select-filter">
                            <option value="">Sắp xếp theo</option>
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
            {{$all_products->links('pages.pagination.front')}}
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

    <script>
        const menuLi = document.querySelectorAll('.menu-filter > ul > li > a')
        const subMenu = document.querySelectorAll('.sub-menu-filter')
        for (let index = 0; index < menuLi.length; index++) {
            menuLi[index].addEventListener('click',(e)=>{
                e.preventDefault()
                // menuLi[index].parentNode.querySelector('ul').classList.toggle('active')
                // for (let i = 0; i < subMenu.length; i++) {
                //     subMenu[i].setAttribute("style","height: 0px")
                    
                // }
                const submenuHeight = menuLi[index].parentNode.querySelector('ul .sub-menu-item').offsetHeight
                menuLi[index].parentNode.querySelector('ul').setAttribute("style","height:"+submenuHeight+"px");
            })
            
        }
    </script>
</section>

<script>
    // // Lấy tất cả các phần tử div có class "form-group"
    // var formGroups = document.querySelectorAll('.form-group');

    // Lặp qua từng phần tử div và thiết lập sự kiện onchange
    // formGroups.forEach(function(formGroup) {
    //     var select = formGroup.querySelector('select');

    //     // Thiết lập sự kiện onchange cho từng select
    //     select.addEventListener('change', function() {
    //         // Lấy chiều cao của select để tăng khoảng cách giữa các form-group
    //         var selectHeight = select.offsetHeight;

    //         // Tính toán khoảng cách cần tăng dựa trên chiều cao của select
    //         var marginTop = selectHeight + 10; // Thêm 10px làm margin top

    //         // Lặp qua tất cả các phần tử div sau phần tử hiện tại và thay đổi margin top
    //         var nextElement = formGroup.nextElementSibling;
    //         while (nextElement) {
    //             nextElement.style.marginTop = marginTop + 'px';
    //             nextElement = nextElement.nextElementSibling;
    //         }
    //     });
    // });
</script>


@endsection
