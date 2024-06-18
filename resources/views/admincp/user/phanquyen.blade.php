@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cấp quyền User: {{$user->name}} </div>

                <form action="{{url('/insert_permission',[$user->id])}}" method="POST">
                    @csrf
                    @if (!empty($name_roles))
                        <p>Vai trò hiện tại: {{$name_roles}}</p>
                    @else
                        <p>Vai trò hiện tại: Chưa có</p>
                    @endif
                    @foreach ($permission as $key=>$per)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                            @foreach ($get_permission_via_role as $key=>$get)
                                @if ($get->id == $per->id)
                                    checked
                                @endif
                            @endforeach
                            name="permission[]" value="{{$per->id}}" id="{{$per->id}}">
                            <label class="form-check-label" for="{{$per->id}}">
                            {{$per->name}}
                            </label>
                        </div>
                    @endforeach
                    <br>
                    <input type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-success">
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
