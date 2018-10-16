<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Language;
use Modules\Post\Entities\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $languages = Language::all();
        $tags = Tag::all();
        return view('post::tags' , compact('languages' , 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|unique:tags',
            'language' => 'required'
        ]);

        $tag = new Tag();
        $tag->title = $request->title;
        $tag->lang_id = $request->language;
        $tag->save();

        Session::flash('success' , 'New Tag was added successfuly');
        return back();

    }

    /**
     * Show the specified resource.
     * @return Response
     */
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
