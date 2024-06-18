@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý loại danh mục</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($children))
                        <form action="{{ route('children.store') }}" method="POST">
                            @csrf
                    @else
                        <form action="{{ route('children.update', $children->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    @endif
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ isset($children) ? $children->title : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ isset($children) ? $children->slug : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" style="resize:none" class="form-control" placeholder="Nhập dữ liệu" id="description">{{ isset($children) ? $children->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ isset($children) && $children->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ isset($children) && $children->status == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>
                        @if (!isset($children))
                            <button type="submit" class="btn btn-success">Thêm dữ liệu</button>
                        @else
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        @endif
                    </form>
                </div>
            </div>
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
                        <form action="{{ route('children.destroy', $cate->id) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>                        
                        <a href="{{route('children.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
