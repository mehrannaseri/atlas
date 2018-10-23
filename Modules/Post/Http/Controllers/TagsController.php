<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Language;
use Modules\Post\Entities\Tag;
use Spatie\Permission\Traits\HasRoles;

class TagsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('read tag')){
            $languages = Language::all();
            $tags = Tag::all();
            return view('post::tags' , compact('languages' , 'tags'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create tag')){
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
        else{
            return view('layouts.error.403');
        }

    }

    public function update($id,Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('update tag')){
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
        else{
            return view('layouts.error.403');
        }
    }

    public function destroy($id)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('destroy tag')){
            $tag = Tag::find($id);
            $tag->posts()->sync([]);
            $tag->delete();

            Session::flash('delete' , 'Tag was deleted successfuly');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }
}
