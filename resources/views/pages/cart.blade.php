@extends('layout')
@section('content')
<!-- cart -->
<form action="{{route('order')}}" method="POST">
    <section class="cart-section p-to-top">
        <div class="container">
            <div class="row-grid">
                <p class="heading-text-p">Giỏ hàng</p>
            </div>
            <div class="row-grid"> 
                <div class="cart-section-left">
                    <h2 class="main-h2">Chi tiết đơn hàng</h2>
                    <div class="cart-section-left-detail">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $cart = Session::get('cart', []);
                                @endphp
                                @if(empty($cart))
                                    <td colspan="4" style="text-align: center;height:100px;font-weight:bold">Giỏ hàng trống</td>
                                @else
                                    @foreach ($product as $key => $pro)
                                        @php
                                            $product_data = $cart[$pro->id];
                                            $price = $pro->price * $product_data['quantity'];
                                            $total += $price;
                                        @endphp
                                        <tr>
                                            <td><img style="width: 70px;" src="{{asset('uploads/product/'.$pro->image)}}" alt=""></td>
                                            <td>
                                                <div class="product-detail-right-infor">
                                                    <h1 style="font-size: large;">{{$pro->title}}</h1>
                                                    <div class="hot-product-item-price">
                                                        @if ($pro->color == 0)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Đỏ</p>
                                                        @elseif ($pro->color == 1)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Trắng</p>
                                                        @elseif ($pro->color == 2)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Đen</p>
                                                        @elseif ($pro->color == 3)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Xanh Lam</p>
                                                        @elseif ($pro->color == 4)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Xanh Lá</p>
                                                        @elseif ($pro->color == 5)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Be</p>
                                                        @elseif ($pro->color == 6)
                                                            <p style="font-size: small; font-weight: 500;">Màu: Nâu</p>
                                                        @endif
                                                        {{-- <p>{{$a}}</p> --}}
                                                        <p style="font-size: small; font-weight: 500;">SIZE: {{ $product_data['size'] }}</p>
                                                        <p style="font-size: small; font-weight: 500;">{{number_format($pro->price)}}<sup>đ</sup> </p>
                                                    </div>
                                                </div>
                                                <div class="product-detail-right-quantity-input">
                                                    <i class="ri-subtract-line"></i>
                                                    <input class="quantity-input" onkeydown="return false" name="product_id[{{ $pro->id }}]" type="number" value="{{ $product_data['quantity'] }}">
                                                    <input type="hidden" name="product_size[{{ $pro->id }}]" value="{{ $product_data['size'] }}">
                                                    <i class="ri-add-line"></i>
                                                </div>
                                                {{-- <div class="product-detail-right-quantity-input">
                                                    <i class="ri-subtract-line"></i>
                                                    <input class="quantity-input" onkeydown="return false" name="product_id[{{ $pro->id }}]" type="number" value="{{ $product_data['quantity'] }}">
                                                    <i class="ri-add-line"></i>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <p>{{number_format($price)}}<sup>đ</sup></p>
                                            </td>
                                            <td class="delete"><a href="{{route('cart_delete',$pro->id)}}"><i class="ri-close-fill"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td colspan="2" style="font-weight:bold;">Tổng tiền</td>
                                    <td colspan="" style="text-align: center; color:red; font-size:large;font-weight:bold;">{{number_format($total)}}<sup>đ</sup></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <button formaction="{{route('cart_update')}}" class="main-btn">Cập nhật giỏ hàng</button>
                        <a class="continue" style="color: crimson; font-style: italic;" href="{{route('homepage')}}">>>Tiếp tục mua hàng</a>
                    </div>
                </div>
                <div class="cart-section-right">
                    <h2 class="main-h2">Thông tin giao hàng</h2>
                    <div class="cart-section-right-input-name-phone">
                        <input type="text" placeholder="Tên" name="name" id="">
                        <input type="text" placeholder="Điện thoại" name="phone" id="">
                    </div>
                    <div class="cart-section-right-input-email">
                        <input type="text" placeholder="Email" name="email" id="">
                    </div>
                    <div class="cart-section-right-input-select">
                        <select name="city" id="city">
                            <option value="1">Tỉnh/TP</option>
                        </select>
                        <select name="district" id="district">
                            <option value="1">Quận/Huyện</option>
                        </select>
                        <select name="ward" id="ward">
                            <option value="1">Phường/Xã</option>
                        </select>
                    </div>
                    <div class="cart-section-right-input-adress">
                        <input type="text" placeholder="Địa chỉ" name="address" id="">
                    </div>
                    <div class="cart-section-right-input-note">
                        <input type="text" placeholder="Ghi chú" name="note" id="">
                    </div>
                    <button class="main-btn">Gửi đơn hàng</button>
                </div>
            </div>
        </div>
    </section>
    @csrf
</form>


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
                @if (!empty($pro->collection))
                    <a href="{{route('collection',$pro->collection->slug)}}" class="test-anh"><img src="{{asset('uploads/collection/icon/'.$pro->collection->icon)}}" style="z-index: 0"></a>
                @endif
                <p><a href="{{route('product',$pro->slug)}}">{{$pro->title}}</a></p>
                <span>{{$pro->material}}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>



{{-- api vùng miền --}}
<script type='text/javascript'>
    const host = "https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1";
    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "city");
            });
    }
    callAPI('https://vn-public-apis.fpo.vn/districts/getAll?limit=-1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }


    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }


    $("#city").change(() => {
        callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
    
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
    
    });
    $("#ward").change(() => {
    
    })
</script>
@endsection