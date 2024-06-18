@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Icon</th>
      <th scope="col">Banner</th>
      <th scope="col">Slug</th>
      <th scope="col">Active/Inactive</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody class="order_position">
  @foreach ($list as $key => $cate)
    <tr id="{{$cate->id}}">
      <th scope="row">{{$key}}</th>
      <td>{{$cate->title}}</td>
      <td style="text-align: center"><img width="30%" height="30%"  src="{{asset('uploads/collection/image/'.$cate->image)}}" alt=""></td>
      <td style="text-align: center"><img width="80%" height="80%"  src="{{asset('uploads/collection/icon/'.$cate->icon)}}" alt=""></td>
      <td style="text-align: center"><img width="30%" height="30%"  src="{{asset('uploads/collection/banner/'.$cate->banner)}}" alt=""></td>
      <td>{{$cate->slug}}</td>
      <td>
          @if ($cate->status)
              Hiển thị
          @else
              Không hiển thị
          @endif
      </td>
      <td>
          <form action="{{ route('collection.destroy', $cate->id) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa?')">
              @csrf
              @method('DELETE')
              @can('xoa bo suu tap')
              <button type="submit" class="btn btn-danger">Xóa</button>
              @endcan
          </form>     
          @can('sua bo suu tap')                   
          <a href="{{route('collection.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
          @endcan
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection