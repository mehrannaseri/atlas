<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\Language;

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

        return view('dashboard' , compact('languages'));
    }

    public function addLanguage(Request $request)
    {

        $this->validate($request , [
            'language' => 'required',
            'flag'     => 'required|max:2|unique:languages'
        ],[
            'language.required' => 'The Title field is required.'
        ]);

        $language = new Language();

        $language->title = $request->language;
        $language->flag = $request->flag;
        $language->save();

        Session::flash('success' , 'New language was added to site successfuly');

        return back();
    }

    public function update($id,Request $request)
    {
        $lang = Language::findOrfail($id);
        $this->validate($request , [
            'language' => 'required',
            'flag'     => 'required|max:2|unique:languages,flag,'.$lang->id,
        ],[
            'language.required' => 'The Title field is required.'
        ]);

        $lang->title = $request->language;
        $lang->flag = $request->flag;
        $lang->save();

        Session::flash('success' , 'The language was Updated successfuly');

        return back();
    }

    public function delete($id)
    {
        $lang = Language::findOrfail($id);

        $lang->delete();

        Session::flash('delete' , 'The language was removed from list');

        return back();

    }
}
