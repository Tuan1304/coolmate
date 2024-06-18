@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cấp vai trò User </div>

                <form action="{{url('/insert_roles',[$user->id])}}" method="POST">
                    @csrf
                    <div class="form-check-container">
                    @foreach ($role as $key => $r)
                        @if (!empty($all_column_roles))
                        <div class="form-check form-check-inline" style="">
                            <input class="form-check-input" {{$r->id==$all_column_roles->id ? 'checked' : ''}} type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                            <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                        </div>
                        @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                            <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                        </div>
                        @endif
                    @endforeach
                </div>
                <br>
                    <input type="submit" name="insertroles" value="Cấp vai trò cho user" class="btn btn-success">
                </form>
                
            </div>
            
        </div>
    </div>
    <style>
        .form-check-container {
            display: flex;
            flex-wrap: wrap; /* Tùy chọn, nếu bạn muốn các phần tử xuống dòng khi không đủ không gian */
        }

        .form-check-inline {
            margin-right: 10px; /* Khoảng cách giữa các input */
        }
    </style>
</div>
@endsection
