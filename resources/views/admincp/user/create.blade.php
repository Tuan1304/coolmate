@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm User </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($user))
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                    @else
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    @endif
                        <div class="form-group">
                            <label for="name">Tên User</label>
                            <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" class="form-control" placeholder="Nhập dữ liệu">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ isset($user) ? $user->email : '' }}" class="form-control" placeholder="Nhập dữ liệu">                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" value="{{ isset($user) ? $user->password : '' }}" class="form-control" placeholder="Nhập dữ liệu">                     
                        </div>
                        @if (!isset($user))
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
