@extends('layouts.app')

@section('content')

<div class="card-header">Liệt kê user</div>
<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên User</th>
      <th scope="col">Email</th>
      {{-- <th scope="col">Password</th> --}}
      <th scope="col">Vai trò</th>
      <th scope="col">Quyền</th>
      <th scope="col">Quản lý</th>  
    </tr>
  </thead>
  <tbody class="order_position">
    @foreach ($user as $key => $user)
    <tr id="{{$user->id}}">
      <th scope="row">{{$key}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      {{-- <td>{{$user->password}}</td> --}}
      <td>
        @foreach ($user->roles as $key=>$role)
          {{$role->name}}
        @endforeach
      </td>
      <td>
        @foreach ($role->permissions as $key=>$permission)
          <h4><span class="badge badge-dark">{{$permission->name}}</span></h4>
        @endforeach
      </td>
      <td>
        @role('admin')
        <a href="{{url('phan-vaitro/'.$user->id)}}" class="btn btn-success">Phân vai trò</a>
        <a href="{{url('phan-quyen/'.$user->id)}}" class="btn btn-danger">Phân quyền</a>
        <a href="{{ url('impersonate/user/'.$user->id) }}" class="btn btn-primary">Chuyển quyền nhanh</a>
        @endrole
      </td>  
    </tr>
    @endforeach
  </tbody>
</table>

@endsection