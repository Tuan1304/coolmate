@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý Thời trang nam</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($man))
                        <form action="{{ route('man.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    @else
                        <form action="{{ route('man.update', $man->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    @endif
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ isset($man) ? $man->title : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ isset($man) ? $man->slug : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" style="resize:none" class="form-control" placeholder="Nhập dữ liệu" id="description">{{ isset($man) ? $man->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ isset($man) && $man->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ isset($man) && $man->status == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="image">Image</label> <br>  
                            <input type="file" name="image" class="form-control-file">
                            @if (isset($man))
                                <img width="20%" height="20%"  src="{{ asset('uploads/man/'.$man->image) }}" alt="">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">{{ !isset($man) ? 'Thêm dữ liệu' : 'Cập nhật' }}</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
