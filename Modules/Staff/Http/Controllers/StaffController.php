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
use Spatie\Permission\Traits\HasRoles;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('read staff')){
            $users = User::all();
            return view('staff::index', compact('users'));
        }
        else{
            return view('layouts.error.404');
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create staff')) {
            $roles=Role::all();
            return view('staff::create' ,compact('roles'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create staff')){
            $request->validate([
                'name'     => 'required',
                'email'    => 'required|unique:users|email',
                'password' => 'required|min:6|confirmed',
                'mobile'   => 'integer|nullable',
                'avatar'   => 'mimes:jpeg,png|nullable',
                'role'     => 'required',
            ]);
            $avatar = null;
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $name= time().$file->getClientOriginalName();
                $file->move(public_path().'/files/staff/', $name);
                $avatar = '/files/staff/'.$name;
            }

            $user = new User();
            $user->name   = $request->name;
            $user->lname  = $request->lname;
            $user->mobile = $request->mobile;
            $user->avatar = $avatar;
            $user->email  = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $role=Role::findById($request->role);

            $user->assignRole($role->name);

            Session::flash('success' , 'New staff was added successfuly');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function access_level()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('access level')) {
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
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('access level')){
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

    public function show()
    {
        return view('staff::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('staff::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
