<?php

namespace Modules\Staff\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Traits\HasRoles;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('staff::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create staff')) {
            return view('staff::create');
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
                'avatar'   => 'mimes:jpeg,png|nullable'
            ]);
            $avatar = null;
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $name= time().$file->getClientOriginalName();
                $file->move(public_path().'/files/staff/', $name);
                $avatar = '/files/posts/'.$name;
            }

            $user = new User();
            $user->name   = $request->name;
            $user->lname  = $request->lname;
            $user->mobile = $request->mobile;
            $user->avatar = $avatar;
            $user->email  = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            Session::flash('success' , 'New staff was added successfuly');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
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
