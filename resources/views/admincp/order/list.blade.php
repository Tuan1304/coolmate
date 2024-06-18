@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <a href="{{route('order.create')}}" class="btn btn-primary">Thông tin đơn hàng</a>
                <div class="card-header">Chi tiết đơn hàng</div>
                <div class="admin-content-main-content">
                    <div class="admin-content-main-content-order-list">
                        <table>
                            <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Quantity</th>
                                  <th scope="col">Money</th>
                                  <th scope="col">Delete</th>
                                </tr>
                              </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($product as $key=>$pro)
                                @php 
                                    $price = $pro -> price*$order_detail[$pro->id];
                                    $total += $price;
                                @endphp
                                    <tr>
                                        <td>{{$pro->id}}</td>
                                        <td><img style="width: 70px;" src="{{asset('uploads/product/'.$pro->image)}}" alt=""></td>
                                        <td>{{$pro->title}}</td>
                                        <td>{{number_format($pro->price)}}</td>
                                        <td>{{$order_detail[$pro->id]}}</td>
                                        <td>{{number_format($price)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="font-weight: 700;" colspan="5">Tổng cộng</td>
                                    <td style="font-weight: 700;">{{number_format($total)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
        </div>
    </div>
    <style>
        .btn-comfirm {
            white-space: nowrap;
            background-color: blue;
            color: white;
        }
        .admin-content-main-title h1 {
            font-size: large;
            padding: 12px 6px;
            font-weight: 500;
            position: relative;
        }
        .admin-content-main-title h1::before {
            position: absolute;
            display: block;
            content: "";
            height: 4px;
            width: 70px;
            background-color: var(--main-bg-color);
            bottom: 6px;
            left: 6px;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px;
        }
        .admin-content-main-content-product-add {
            display: grid;
            grid-template-columns: 75% 15%;
            padding-top: 20px;
            padding-left: 20px;
            column-gap: 20px;
            background-color: #2c3135;;
        }
        .admin-content-main-content-left {
            max-height: 600px;
            overflow: scroll;
        }
        .admin-content-main-content-left input {
            height: 40px;
            border: none;
            background-color: var(--sug-bg-color);
            margin-bottom: 20px;
            outline: none;
            border-radius: var(--main-border-radius);
        }
        .admin-content-main-content-two-input {
            display: flex;
            justify-content: space-between;
        }
        .admin-content-main-content-two-input input {
            width: 43%;
        }
        /* .admin-content-main-content-left textarea {
            height: 200px;
            width: 100%;
            margin-bottom: 20px;
            outline: none;
            border: none;
            padding: 6px 0;
        } */
        .admin-content-main-content-right {
            padding-left: 12px;
        }
        .admin-content-main-content-right-img {
            border-radius: var(--main-border-radius);
        }
        .admin-content-main-content-right-img input {
            display: none;
        }
        .admin-content-main-content-right-imgs input {
            display: none;
        }
        .admin-content-main-content-right label {
            padding: 6px 12px;
            background-color: var(--main-bg-color);
            color: whitesmoke;
            cursor: pointer;
            display: inline-block;
            border-radius: var(--main-border-radius);
        }
        .admin-content-main-content-order-list {
            padding-top: 12px;
        }
        .admin-content-main-content-order-list table {
            width: 100%;
            background-color: white;
            padding: 12px 0;
            border-collapse: collapse;
        }
        .admin-content-main-content-order-list table a {
            display: block;
        }
        .admin-content-main-content-order-list table,th,td {
            text-align: center;
        }
        .admin-content-main-content-order-list table td {
            padding: 6px 2px;

        }
        .admin-content-main-content-order-list table th {
            background-color: #2c3135;;
            color: white;
            padding: 6px 2px;
        }
    </style>
</div>
@endsection
