@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý Thông tin</div>
                <div class="admin-content-main-content">
                    <div class="admin-content-main-content-order-list">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Phone</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Address</th>
                                  <th scope="col">Note</th>
                                  <th scope="col">Detail</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Delete</th>

                                </tr>
                              </thead>
                            <tbody>
                                @foreach ($order as $key => $order)
                                <tr id="{{$order->id}}">
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->note}}</td>
                                    <td>
                                        <a class="btn btn-comfirm" href="/admin/order/{{$order->order_detail}}">Xem</a>
                                    </td>
                                    <td>{{$order->updated_at}}</td>
                                    @if ($order->status == 1)
                                        <td><a class="btn btn-success" href="" style="white-space: nowrap;">Đã xác nhận</a></td>
                                    @else
                                        <td><a class="btn btn-warning" href="" style="white-space: nowrap;">Chưa xác nhận</a></td>
                                    @endif
                                    <td>
                                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            <table class="table">
                
              </table>
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
