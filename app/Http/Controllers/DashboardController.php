<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\Language;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $languages = Language::all();

        return view('dashboard', compact('languages'));
    }

    public function addLanguage(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create language')) {
            $this->validate($request, [
                'language' => 'required',
                'flag' => 'required|max:2|unique:languages'
            ], [
                'language.required' => 'The Title field is required.'
            ]);

            $language = new Language();

            $language->title = $request->language;
            $language->flag = $request->flag;
            $language->save();

            Session::flash('success', 'New language was added to site successfuly');

            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function update($id,Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('update language')) {
            $lang = Language::findOrfail($id);
            $this->validate($request, [
                'language' => 'required',
                'flag' => 'required|max:2|unique:languages,flag,' . $lang->id,
            ], [
                'language.required' => 'The Title field is required.'
            ]);

            $lang->title = $request->language;
            $lang->flag = $request->flag;
            $lang->save();

            Session::flash('success', 'The language was Updated successfuly');

            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function delete($id)
    {
        if(auth()->user()->hasRole('admin') ||auth()->user()->hasPermissionTo('destroy language')) {
            $lang = Language::findOrfail($id);

            $lang->delete();

            Session::flash('delete' , 'The language was removed from list');

            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function setDir(Request $request)
    {
        if($request->from == 'post'){
            return Language::with('tags')->with('categories')->where('id' , $request->lang)->get();
        }
        else if($request->from == 'exhibition'){
            return Language::where('id' , $request->lang)->get();
        }

    }
}
