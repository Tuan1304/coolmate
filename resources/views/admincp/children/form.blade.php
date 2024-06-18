@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý Thời trang trẻ em</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($children))
                        <form action="{{ route('children.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    @else
                        <form action="{{ route('children.update', $children->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="image">Image</label> <br>  
                            <input type="file" name="image" class="form-control-file">
                            @if (isset($children))
                                <img width="20%" height="20%"  src="{{ asset('uploads/children/'.$children->image) }}" alt="">
                            @endif
                        </div>
                        @if (!isset($children))
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
