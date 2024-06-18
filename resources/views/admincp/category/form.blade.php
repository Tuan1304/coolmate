@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($category))
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                    @else
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    @endif
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ isset($category) ? $category->title : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ isset($category) ? $category->slug : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" onkeyup="ChangeToSlug()">                            
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" style="resize:none" class="form-control" placeholder="Nhập dữ liệu" id="description">{{ isset($category) ? $category->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                            <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>
                        @if (!isset($category))
                            <button type="submit" class="btn btn-success">Thêm dữ liệu</button>
                        @else
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        @endif
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
