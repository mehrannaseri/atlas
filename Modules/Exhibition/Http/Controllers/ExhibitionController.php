<?php

namespace Modules\Exhibition\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Exhibition\Entities\Exhibition;
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
     * Display a listing of the Exhibition.
     * @return Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('read exhibition')){

            $exhibitions = Exhibition::with('state')->with('city')->with('lang')->orderBy('start_holding' , 'desc')->get();

            return view('exhibition::index' , compact('exhibitions'));
        }
        else{
            return view('layouts.error.404');
        }

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
     * Store a newly created exhibition in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create exhibition')){
            $request->validate([
                'language'      => 'required',
                'title'         => 'required',
                'state'         => 'required',
                'city'          => 'required',
                'start_holding' => 'required|date_format:Y-m-d',
                'end_holding'   => 'required|date_format:Y-m-d',
                'start_reg'     => 'required|date_format:Y-m-d',
                'end_reg'       => 'required|date_format:Y-m-d',
                'pavilion_num'  => 'integer|nullable',
                'cpm'           => 'regex:/[0-9]+[.,]?[0-9]*/|nullable',
            ],[
                'state.required'            => 'Choosing the province is the venue for the exhibition',
                'start_holding.required'    => 'The start date of the exhibition is compulsory',
                'start_holding.date_format' => 'The format of the start date of the fair is incorrect',
                'end_holding.required'      => 'The end date of the exhibition is compulsory',
                'end_holding.date_format'   => 'The format of the end date of the fair is incorrect',
                'start_reg.required'        => 'The registration date of the exhibition is mandatory',
                'start_reg.date_format'     => 'The format of the registration date of the fair is incorrect',
                'cpm.integer'               => 'The cost should include numbers'
            ]);

            $cpm = NULL;
            if($request->has('cpm') && $request->cpm !== ""){
                $cpm =  str_replace(",","",$request->cpm);
            }

            $exhib = new Exhibition();
            $exhib->lang_id = $request->language;
            $exhib->state_id = $request->state;
            $exhib->city_id = $request->city;
            $exhib->title = $request->title;
            $exhib->start_holding = $request->start_holding;
            $exhib->end_holding = $request->end_holding;
            $exhib->start_reg = $request->start_reg;
            $exhib->end_reg = $request->end_reg;
            $exhib->pavilion_num = $request->pavilion_num;
            $exhib->cpm = $cpm;
            $exhib->address = $request->address;
            $exhib->save();

            Session::flash('success' , 'New Exhibition was added successfully');
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
     * * @param  Request $request
     * @return Response
     */
    public function cityList(Request $request)
    {
        $state = State::find($request->id);
        return $state->cities()->get();
    }
}
