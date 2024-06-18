@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý bộ sưu tập</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($collection))
                        <form action="{{ route('collection.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    @else
                        <form action="{{ route('collection.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    @endif
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ isset($collection) ? $collection->title : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ isset($collection) ? $collection->slug : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" onkeyup="ChangeToSlug()">                            
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                            <option value="1" {{ isset($collection) && $collection->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ isset($collection) && $collection->status == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label> <br>  
                            <input type="file" name="image" class="form-control-file">
                            @if (isset($collection))
                                <img width="20%" height="20%"  src="{{ asset('uploads/collection/image/'.$collection->image) }}" alt="">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label> <br>  
                            <input type="file" name="icon" class="form-control-file">
                            @if (isset($collection))
                                <img width="20%" height="20%"  src="{{ asset('uploads/collection/icon/'.$collection->icon) }}" alt="">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="banner">Banner</label> <br>  
                            <input type="file" name="banner" class="form-control-file">
                            @if (isset($collection))
                                <img width="20%" height="20%"  src="{{ asset('uploads/collection/banner/'.$collection->banner) }}" alt="">
                            @endif
                        </div>
                        @if (!isset($collection))
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
