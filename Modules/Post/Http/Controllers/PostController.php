<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Language;
use Modules\Post\Entities\Tag;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('post::index');
    }

    public function create()
    {
        $languages = Language::all();


        return view('post::create' , compact('languages'));
    }

    public function setDir(Request $request)
    {
        return Language::with('tags')->with('categories')->where('id' , $request->lang)->get();
    }

    public function store(Request $request)
    {

        $request->validate([
           'language'    => 'required',
           'title'       => 'required',
           'category'    => 'required',
        ]);


    }

    public function show()
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('post::edit');
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
