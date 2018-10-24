<?php

namespace Modules\Staff\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function access_level()
    {
        if(auth()->user()->hasRole('admin')) {
            $users = User::all();
            $permissions = Permission::all();

            $list = Module::all();
            $result = implode(",", $list);
            $modules = explode(",", $result);

            return view('staff::access_level', compact('users', 'permissions', 'modules'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    public function setPermission(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            $user = User::find($request->user);
            if($user->id != auth()->user()->id){
                if($request->has('deletedPermission') && $request->deletedPermission != ""){
                    $deletedPermission = explode("," , $request->deletedPermission);
                    foreach($deletedPermission as $delPremission){
                        $user->revokePermissionTo($delPremission);
                    }
                }

                if($request->permissions != ""){
                    $newPermission = explode("," , $request->permissions);
                    $user->givePermissionTo($newPermission);
                }

                Session::flash('success' , 'Permission changes save successfuly');
                return back();
            }
            else{
                Session::flash('error' , 'You can not change your access level');
                return back();
            }

        }
        else{
            return view('layouts.error.403');
        }

    }

    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            $roles = Role::orderBy('id' , 'desc')->get();

            return view('staff::roles' , compact('roles'));
        }
        else{
            return view('layouts.error.404');
        }

    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin')) {
            $request->validate([
                'name' => 'required|unique:roles'
            ], [
                'name.required' => 'The Role name field is required.',
                'name.unique' => 'The Role name has already been taken.'
            ]);
            Role::create(['name' => $request->name]);

            Session::flash('success', 'The new Role was added successfully');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function update($id,Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            $role = Role::findById($id);
            $request->validate([
                'name'  => 'required|unique:roles,name,'.$role->id,
            ],[
                'name.required' => 'The Role name field is required.',
                'name.unique' => 'The Role name has already been taken.'
            ]);

            $role->name = $request->name;
            $role->save();

            Session::flash('success', 'The Role was updated successfully');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function destroy()
    {
    }
}
