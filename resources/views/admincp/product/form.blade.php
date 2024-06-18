@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            {{-- <a href="{{route('product.index')}}" class="btn btn-primary">Liệt kê sản phẩm</a> --}}
                <div class="card-header">Quản lý sản phẩm</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($product))
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @endif
                        @csrf 
                        <div class="form-group">
                            <label for="title">Tên</label>
                            <input type="text" name="title" value="{{ isset($product) ? $product->title : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ isset($product) ? $product->slug : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="convert_slug" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="price">Gía bán</label>
                            <input type="text" name="price" value="{{ isset($product) ? $product->price : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="price">
                        </div>
                        <div class="form-group">
                            <label for="cost">Gía gốc</label>
                            <input type="text" name="cost" value="{{ isset($product) ? $product->cost : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="cost">
                        </div>
                        <div class="form-group">
                            <label for="material">Chất liệu</label>
                            <input type="text" name="material" value="{{ isset($product) ? $product->material : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="material">
                        </div>
                        <div class="form-group">
                            <label for="color">Màu sắc</label>
                            <select name="color" class="form-control">
                                <option value="0" {{ isset($product) && $product->color == 0 ? 'selected' : '' }}>Đỏ</option>
                                <option value="1" {{ isset($product) && $product->color == 1 ? 'selected' : '' }}>Trắng</option>
                                <option value="2" {{ isset($product) && $product->color == 2 ? 'selected' : '' }}>Đen</option>
                                <option value="3" {{ isset($product) && $product->color == 3 ? 'selected' : '' }}>Xanh Lam</option>
                                <option value="4" {{ isset($product) && $product->color == 4 ? 'selected' : '' }}>Xanh Lá</option>
                                <option value="5" {{ isset($product) && $product->color == 5 ? 'selected' : '' }}>Be</option>
                                <option value="6" {{ isset($product) && $product->color == 6 ? 'selected' : '' }}>Nâu</option>
                                <option value="7" {{ isset($product) && $product->color == 7 ? 'selected' : '' }}>Xám</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Thông tin</label>
                            <textarea name="description" style="resize:none" class="editor_content" placeholder="Nhập dữ liệu" id="description">{{ isset($product) ? $product->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="compare">So sánh giá cả</label>
                            <input type="text" name="compare" value="{{ isset($product) ? $product->compare : '' }}" class="form-control" placeholder="Nhập dữ liệu" id="material">
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Danh mục</label>
                            <select name="category_id" class="form-control">
                                <option value="0" {{ isset($product) && $product->category_id == 0 ? 'selected' : '' }}>Không</option>
                                @foreach($category as $key => $value)
                                    <option value="{{ $key }}" {{ isset($product) && $product->category_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="collection">Bộ sưu tập</label>
                            <select name="collection_id" class="form-control">
                                <option value="0" {{ isset($product) && $product->collection_id == 0 ? 'selected' : '' }}>Không</option>
                                @foreach($collection as $key => $value)
                                    <option value="{{ $key }}" {{ isset($product) && $product->collection_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="children">Trẻ em</label>
                            <select name="children_id" class="form-control">
                                <option value="0" {{ isset($product) && $product->children_id == 0 ? 'selected' : '' }}>Không</option>
                                @foreach($children as $key => $value)
                                    <option value="{{ $key }}" {{ isset($product) && $product->children_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="women">Nữ</label>
                            <select name="women_id" class="form-control">
                                <option value="0" {{ isset($product) && $product->women_id == 0 ? 'selected' : '' }}>Không</option>
                                @foreach($women as $key => $value)
                                    <option value="{{ $key }}" {{ isset($product) && $product->women_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="man">Nam</label>
                            <select name="man_id" class="form-control">
                                <option value="0" {{ isset($product) && $product->man_id == 0 ? 'selected' : '' }}>Không</option>
                                @foreach($man as $key => $value)
                                    <option value="{{ $key }}" {{ isset($product) && $product->man_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hot_product">Sản phẩm hot</label>
                            <select name="hot_product" class="form-control">
                                <option value="1" {{ isset($product) && $product->hot_product == 1 ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ isset($product) && $product->hot_product == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh chính</label> <br>  
                            <input type="file" name="image" class="form-control-file">
                            @if (isset($product))
                                <img width="20%" height="20%"  src="{{ asset('uploads/product/'.$product->image) }}" alt="">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="images">Ảnh phụ</label> <br>  
                            <input type="file" name="images[]" multiple class="form-control-file" enctype="multipart/form-data">
                        </div>
                        @if (!isset($product))
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

<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
<script src="{{asset('ckeditor5/script.js')}}"></script>

@endsection 
