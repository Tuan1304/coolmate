@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <a href="{{route('product.create')}}" class="btn btn-primary">Thêm sản phẩm</a> --}}
            <table class="table table-responsive" id="tableweb">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    {{-- <th scope="col">Description</th> --}}
                    {{-- <th scope="col">Slug</th> --}}
                    <th scope="col">Hot</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Price</th>
                    <th scope="col">Color</th>
                    <th scope="col">Material</th>
                    <th scope="col">Gía gốc</th>
                    {{-- <th scope="col">Category</th> --}}
                    <th scope="col">Children</th> 
                    <th scope="col">Women</th>
                    <th scope="col">Man</th>
                    <th scope="col">Ngày cập nhật</th>
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody class="order_position">
                @foreach ($list as $key => $cate)
                  <tr id="{{$cate->id}}">
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->title}}</td>
                    <td style="text-align: center"><img width="50%" height="50%"  src="{{asset('uploads/product/'.$cate->image)}}" alt=""></td>
                    {{-- <td>{{$cate->description}}</td> --}}
                    {{-- <td>{{$cate->slug}}</td> --}}
                    <td>
                        @if ($cate->hot_product==1)
                            Hiển thị
                        @else
                            Không hiển thị
                        @endif
                    </td>
                    <td>
                        @if ($cate->status)
                            Hiển thị
                        @else
                            Không hiển thị
                        @endif
                    </td>
                    <td>{{$cate->price}}</td>
                    <td>
                        @if ($cate->color==0)
                            Đỏ
                        @elseif($cate->color==1)
                            Trắng
                        @elseif($cate->color==2)
                            Đen
                        @elseif($cate->color==3)
                            Xanh Lam
                        @elseif($cate->color==4)
                            Xanh Lá
                        @elseif($cate->color==5)
                            Be
                        @elseif($cate->color==6)
                            Nâu
                        @endif
                    </td>
                    <td>{{$cate->material}}</td>
                    <td>{{$cate->cost}}</td>
                    {{-- <td>{{$cate->category->title}}</td> --}}
                    <td>
                        @if (isset($cate->children)&&$cate->children_id!=0)
                            {{$cate->children->title}}
                        @else
                            Không
                        @endif   
                    </td>
                    <td>
                        @if (isset($cate->women)&&$cate->women_id!=0)
                            {{$cate->women->title}}
                        @else
                            Không
                        @endif 
                    </td>
                    <td>
                        @if (isset($cate->man)&&$cate->man_id!=0)
                            {{$cate->man->title}}
                        @else
                            Không
                        @endif 
                    </td>
                    <td>{{$cate->ngaycapnhat}}</td>
                    <td>
                        <form action="{{ route('product.destroy', $cate->id) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            @can('xoa san pham')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                            @endcan
                        </form>      
                        @can('sua san pham')                  
                        <a href="{{route('product.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                        @endcan
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
