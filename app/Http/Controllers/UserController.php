<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'tat ca san pham']);
        // $role = Role::find(3);
        // $permission = Permission::find(10);
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        // $role->syncPermissions($permissions);
        // $permission->syncRoles($roles);
        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);
        // auth()->user()->assignRole('admin');
        // auth()->user()->givePermissionTo('edit articles');
        // auth()->user()->removeRole('admin');
        // dd(auth()->user());
        // $impersonatedUserId = Session::get('impersonate');
        // if ($impersonatedUserId) {
        //     $user = User::find($impersonatedUserId);
        //     $role = Role::orderBy('id','DESC')->get();
        //     return view('admincp.user.index', compact('user', 'role'));
        // } else {
        //     $user = Auth::user();
        //     $role = Role::orderBy('id','DESC')->get();
        //     return view('admincp.user.index', compact('user', 'role'));
        // }
        $user = User::with('roles','permissions')->get();
        return view('admincp.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $user = Auth::user();
        return view('admincp.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save(); 
        return redirect()->back()->with('status','Thêm User thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function phanvaitro($id) {
        $user = User::find($id);
        $role = Role::orderBy('id','DESC')->get();
        $permission = Permission::orderBy('id','DESC')->get();
        // $name_roles = $user->roles->first()->name;
        $all_column_roles = $user->roles->first();
        return view('admincp.user.phanvaitro',compact('user','role','all_column_roles','permission'));
    }
    public function phanquyen($id) {
        $user = User::find($id);
        // $role = Role::orderBy('id','DESC')->get();
        $permission = Permission::orderBy('id','DESC')->get();
        // $name_roles = $user->roles->first()->name;
        $name_roles = $user->roles->first()->name;

        $get_permission_via_role = $user->getPermissionsViaRoles();
        // dd($get_permission_via_role);

        return view('admincp.user.phanquyen',compact('user','name_roles','permission','get_permission_via_role'));
    }
    public function insert_roles(Request $request, $id) {
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        return redirect()->back()->with('status','Thêm vai trò cho user thành công');
    }
    public function insert_permission(Request $request, $id) {
        $data = $request->all();
        $user = User::find($id);
    
        $role_id = $user->roles->first()->id;
        $role = Role::find($role_id);
        
        $permissionNames = Permission::whereIn('id', $data['permission'])->pluck('name')->toArray();

        $permissionsToRemove = $role->permissions()->whereNotIn('name', $permissionNames)->get();
        foreach ($permissionsToRemove as $permissionToRemove) {
            $role->revokePermissionTo($permissionToRemove);
        }
    
        foreach ($permissionNames as $permissionName) {
            $permission = Permission::where('name', $permissionName)->where('guard_name', 'web')->first();
            if ($permission) {
                $role->givePermissionTo($permission);
            } else {
                return redirect()->back()->with('error', 'Quyền ' . $permissionName . ' không tồn tại hoặc không được tạo với guard web.');
            }
        }

        return redirect()->back()->with('status', 'Thêm vai trò cho user thành công');
    }
    public function impersonate($id)
    {
        $user = User::find($id);
        if ($user) {
            Auth::login($user);
            return redirect('/home');
        }
        return redirect('/home');
    }
    
}
