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
            $roles = Role::all();

            return view('staff::roles' , compact('roles'));
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('staff::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
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
