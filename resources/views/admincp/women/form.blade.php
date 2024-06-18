@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý Thời trang nữ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($women))
                        <form action="{{ route('women.store') }}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{ route('women.update', $women->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ isset($women) ? $women->title : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ isset($women) ? $women->slug : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" style="resize:none" class="form-control" placeholder="Nhập dữ liệu" id="description">{{ isset($women) ? $women->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ isset($women) && $women->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ isset($women) && $women->status == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label> <br>  
                            <input type="file" name="image" class="form-control-file">
                            @if (isset($women))
                                <img width="20%" height="20%"  src="{{ asset('uploads/women/'.$women->image) }}" alt="">
                            @endif
                        </div>
                        @if (!isset($women))
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
