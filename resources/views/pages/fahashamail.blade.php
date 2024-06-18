<h1 style="font-size: 20px;font-weight:bold;white-space: nowrap;">Xác nhận đơn hàng của bạn: <p style="font-size: 20px;color: red">{{$nameInfor}}</p></h1>
<div style="font-size: 16px;">Chi tiết đơn hàng:</div>
    <table style="width:100%;text-align:center;border-collapse: collapse;">
        <thead>
            <tr>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Ảnh</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Tên</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Gía</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Số Lượng</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @if($detailInfor)
                @foreach ($product as $key => $pro)
                    @php 
                        // Kiểm tra xem sản phẩm có tồn tại trong $detailInfor không
                        // dd($detailInfor);
                        $quantity = isset($detailInfor[$pro->id]) ? $detailInfor[$pro->id] : 0;
                        $price = $pro->price * $quantity;
                        $total += $price;
                    @endphp
                    <tr>
                        <td style="border: 1px solid #ddd;padding: 8px;"><img style="width: 70px; max-width: 100%; height: auto;" src="{{ url('uploads/product/' . $pro->image) }}" alt=""></td>
                        <td style="border: 1px solid #ddd;padding: 8px;">{{$pro->title}}</td>
                        <td style="border: 1px solid #ddd;padding: 8px;">{{number_format($pro->price)}}</td>
                        <td style="border: 1px solid #ddd;padding: 8px;">{{$quantity}}</td> 
                        <td style="border: 1px solid #ddd;padding: 8px;">{{number_format($price)}}</td>
                    </tr>
                @endforeach
            @endif
        
            {{-- @foreach ($product as $key=>$pro)
            @php
                $price = $pro -> price*$detailInfor[$pro->id];
                $total += $price;
            @endphp
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;"><img style="width: 70px;max-width: 100%;height: auto;" src="{{asset('uploads/product'.$pro->image)}}" alt=""></td>
                    <td style="border: 1px solid #ddd;padding: 8px;">{{$pro->title}}</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">{{number_format($pro->price)}}</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">{{$detailInfor[$pro->id]}}</td> 
                    <td style="border: 1px solid #ddd;padding: 8px;">{{number_format($price)}}</td>
                </tr>
            @endforeach --}}
            <tr>
                <td style="font-weight: 700;border: 1px solid #ddd;padding: 8px;" colspan="4">Tổng cộng</td>
                <td style="font-weight: 700;border: 1px solid #ddd;padding: 8px;">{{number_format($total)}}</td>
            </tr>
        </tbody>
    </table>

    <p style="font-size: 16px">Thông tin giao hàng:</p>
    <table style="width:100%;text-align:center;border-collapse: collapse;">
        <thead>
            <tr>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Tên</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Phone</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Email</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Địa chỉ</th>
            <th scope="col" style="text-align: center;border: 1px solid #ddd;padding: 8px;">Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd;padding: 8px;">{{$nameInfor}}</td>
                <td style="border: 1px solid #ddd;padding: 8px;">{{$phoneInfor}}</td>
                <td style="border: 1px solid #ddd;padding: 8px;">{{$noteInfor}}</td>
                <td style="border: 1px solid #ddd;padding: 8px;">{{$addressInfor}}</td> 
                <td style="border: 1px solid #ddd;padding: 8px;">{{$mailInfor}}</td>
            </tr>
        </tbody> 
    </table>
    {{-- 'order_detail'=>$detailInfor --}}
    {{-- <a href="{{route('accept',['order'=>$idInfor, 'token'=>$tokenInfor, 'order_detail'=>urlencode($detailInfor)])}}" style="font-size: 16px;display:inline-block;background:green;color:#fff;padding:7px 25px;font-weight:bold">Xác nhận đơn hàng</a> --}}
    <a href="{{ route('accept', ['order' => $idInfor, 'token' => $tokenInfor, 'order_detail' => $encodedDetailInfor]) }}" style="font-size: 16px; display: inline-block; background: green; color: #fff; padding: 7px 25px; font-weight: bold;">Xác nhận đơn hàng</a>

    {{-- <a href="/admin/order/{{$idInfor}}/{{$tokenInfor}}/{{$detailInfor}}" style="font-size: 16px;display:inline-block;background:green;color:#fff;padding:7px 25px;font-weight:bold">Xác nhận đơn hàng</a> --}}
    {{-- <a href="/accept-order/{{ $idInfor }}/{{ $tokenInfor }}/{{ $ortailInfor }}" style="font-size: 16px; display: inline-block; background: green; color: #fff; padding: 7px 25px; font-weight: bold;">Xác nhận đơn hàng</a> --}}

    {{-- <p style="font-size: 16px">Trạng thái đơn hàng</p> --}}
    
    
</div>



