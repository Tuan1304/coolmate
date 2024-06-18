<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/reponsive.css')}}">
    <!-- Link CSS của Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Link thư viện jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-vlT7wHvfKHwg5pAsH8jvvDYJJ60vsIt1oSkWnOc7tz9aH/1MbK/8nG2hQRa0JL3cO+0HvYkw3L5JtQohQ1JNNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Web Thời Trang</title>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container">
            <div class="row-flex">
                <div class="header-menu">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="header-logo">
                    <a href="{{route('homepage')}}"><img src="{{asset('imgs/fahasa-logo.png')}}" alt=""></a>
                </div>
                <div class="header-logo-mobile">
                    <img src="{{asset('imgs/fahasa-logo.png')}}" alt="">
                </div>
                <div class="header-nav">
                    <nav>
                        <ul class="menu">
                            <li><a href="{{route('allcollection')}}">Bộ sưu tập</a></li>
                            @foreach ($category as $key => $cate)
                                <li><a href="{{route('category',$cate->slug)}}">{{$cate->title}}</a></li>
                            @endforeach
                            <li>
                                <a href="{{route('allChild')}}">THỜI TRANG TRẺ EM</a>
                                {{-- <ul class="sub-menu">
                                    @foreach ($children as $key => $chil)
                                        <a href="{{route('children',$chil->slug)}}"><li>{{$chil->title}}</li></a>
                                    @endforeach
                                </ul>  --}}
                            </li>
                            <li>
                                <a href="{{route('allwomen')}}">THỜI TRANG NỮ</a>
                                {{-- <ul class="sub-menu">
                                    @foreach ($women as $key => $women)
                                        <a href="{{route('women',$women->slug)}}"><li>{{$women->title}}</li></a>
                                    @endforeach                              
                                </ul> --}}
                            </li>
                            <li>
                                <a href="{{route('allman')}}">THỜI TRANG NAM</a>
                                {{-- <ul class="sub-menu">
                                    @foreach ($man as $key => $men)
                                        <a href="{{route('man',$men->slug)}}"><li>{{$men->title}}</li></a>
                                    @endforeach                              
                                </ul> --}}
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-search">
                    <form action="{{route('tim-kiem')}}" method="GET">
                        <input type="text" name="search" id="timkiem" placeholder="Tim Kiếm...">
                        <button class="btn btn-primary" style="display: none" ></button>
                        <button style="border: none; background: none;  cursor: pointer;"><i class="ri-search-line"></i></button>
                    </form>
                    <ul class="list-group" id="result" style="display: none">
                        
                    </ul>
                </div>
                <div class="header-user">
                    <ul class="menu-user">
                        <li>
                            <a href="#"><i class="ri-user-fill"></i></a>
                            {{-- <i class="ri-user-fill"></i> --}}
                            <ul class="sub-menu-user">
                                {{-- @if (!Auth::user()) --}}
                                    {{-- <a href="{{route('loginpage')}}"> <li>Đăng nhập</li></a> --}}
                                {{-- @else
                                    <a href="{{route('logout-home')}}"> <li>Đăng xuất : {{Auth::user()->name}}</li></a> --}}
                                {{-- @endif --}} 
                                
                            </ul>
                            {{-- <ul class="sub-menu-user" style="text-align: center">
                                <a href="{{route('loginpage')}}"> <li>Thông tin tài khoản</li></a>
                                <a href="{{route('loginpage')}}"> <li>Đăng xuất</li></a> 
                            </ul> --}}
                        </li>                        
                    </ul>  
                </div>
                <div class="header-cart">
                    @php
                        $number = 0;
                        $cart = Session::get('cart', []);
                    @endphp
                    @if(empty($cart))
                    <a href="{{ route('cart') }}"><i class="ri-shopping-cart-fill"></i></a>
                    @else
                        @foreach ($products as $key => $pro)
                            @php
                                if (isset($cart[$pro->id])) {
                                    $product_data = $cart[$pro->id];
                                    $cart_number = $product_data['quantity'];
                                    $number += $cart_number;
                                }
                            @endphp
                        @endforeach
                        <a href="{{ route('cart') }}" class="cart-quantity" number="{{ $number }}"><i class="ri-shopping-cart-fill"></i></a>  
                    @endif
                </div>
                
                
            </div>
        </div>
    </header>
    

    {{-- Content --}}
    @yield('content')

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row-grid">
                <div class="footer-item">
                    <p>THÀNH VIÊN</p>
                    <p>Đăng ký thành viên</p>
                    <p>Ưu đãi và đặc quyền</p>
                </div>
                <div class="footer-item">
                    <p>CHÍNH SÁCH</p>
                    <p>Chính sách đổi trả trong 60 ngày</p>
                    <p>Chính sách khuyến mãi</p>
                    <p>Chính sách bảo mật</p>
                    <p>Chính sách giao hàng</p>
                </div>
                <div class="footer-item">
                    <p>CHĂM SÓC KHÁCH HÀNG</p>
                    <p>Trải nghiệm mua sắm</p>
                    <p>Hỏi đáp</p>
                </div>
                <div class="footer-item">
                    <p>ĐỊA CHỈ LIÊN HỆ</p>
                    <p>Cơ sở 1</p>
                    <p>Cơ sở 2</p>
                    <li style=""></li>
                </div>
            </div>
        </div>
    </footer>

    <script type='text/javascript' src="{{asset('js/script.js')}}"></script>

    

    
</body>
</html>