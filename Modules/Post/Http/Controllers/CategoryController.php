<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Language;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('read category')) {
            $languages = Language::all();
            $categories = Category::with('lang')->with('parent')->get();

            return view('post::category', compact('languages', 'categories'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    public function catsBylang(Request $request)
    {
        return Category::where('parent_id' , null)
                        ->where('lang_id' , $request->lang)
                        ->get();
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create category')) {
            $request->validate([
                'title' => 'required',
                'language' => 'required',
            ]);

            $parent = $request->parent;
            if ($request->parent == "") {
                $parent = null;
            }
            $category = new Category();
            $category->title = $request->title;
            $category->lang_id = $request->language;
            $category->parent_id = $parent;
            $category->save();

            Session::flash('success', 'New Category was added successfuly');

            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    public function update($id,Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('update category')) {
            $request->validate([
                'title' => 'required',
                'language' => 'required',
            ]);

            $parent = $request->parent;
            if ($request->parent == "") {
                $parent = null;
            }

            $cat = Category::find($id);
            $cat->title = $request->title;
            $cat->lang_id = $request->language;
            $cat->parent_id = $parent;
            $cat->save();

            Session::flash('success', 'Category was Updated successfuly');
            return back();
        }
    else{
        return view('layouts.error.403');
    }


    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('destroy category')) {
            $category = Category::find($id);
            $category->posts()->sync([]);
            $category->childs()->update(['parent_id' => null]);
            $category->delete();

            Session::flash('delete', 'Category was deleted successfuly');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }
}
