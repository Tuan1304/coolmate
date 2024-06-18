@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
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
        <td>{{$cate->description}}</td>
        <td>{{$cate->slug}}</td>
        <td>
            @if ($cate->status)
                Hiển thị
            @else
                Không hiển thị
            @endif
        </td>
        <td>
            <form action="{{ route('category.destroy', $cate->id) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa?')">
                @csrf
                @method('DELETE')
                @can('xoa danh muc')
                  <button type="submit" class="btn btn-danger">Xóa</button>
                @endcan
            </form>     
            @can('sua danh muc')
              <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
            @endcan                   
        </td>
      </tr>
    @endforeach
    </tbody>
</table>

@endsection