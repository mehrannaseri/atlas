<?php

namespace Modules\Exhibition\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exhibition\Entities\State;
use Modules\Post\Entities\Language;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class ExhibitionController extends Controller
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

        return view('exhibition::index');
    }

    /**
     * Show the form for creating a new exhibition.
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create exhibition')){
            $languages = Language::all();
            $states = State::all();
            return view('exhibition::create' , compact('languages' , 'states'));
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
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('exhibition::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('exhibition::edit');
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
    
    /**
     * Get City list of State
     */
    public function cityList(Request $request)
    {
        $state = State::find($request->id);
        return $state->cities()->get();
    }
}
