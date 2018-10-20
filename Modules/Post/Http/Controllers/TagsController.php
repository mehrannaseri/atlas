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
    public function __construct()
    {
        $this->middleware('auth');
    }
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

    public function update($id,Request $request)
    {
        $tag = Tag::find($id);

        $request->validate([
            'title'    => 'required|unique:tags,title,'.$tag->id,
            'language' => 'required'
        ]);

        $tag->title = $request->title;
        $tag->lang_id = $request->language;
        $tag->save();

        Session::flash('success' , 'Tag was updated successfuly');
        return back();
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->sync([]);
        $tag->delete();

        Session::flash('delete' , 'Tag was deleted successfuly');
        return back();
    }
}
