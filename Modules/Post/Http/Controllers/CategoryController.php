<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Language;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $languages = Language::all();
        $categories = Category::with('lang')->with('parent')->get();

        return view('post::category' , compact('languages','categories'));
    }


    public function catsBylang(Request $request)
    {
        return Category::where('parent_id' , null)
                        ->where('lang_id' , $request->lang)
                        ->get();
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'language' => 'required',
        ]);

        $parent = $request->parent;
        if($request->parent == ""){
            $parent = null;
        }
        $category = new Category();
        $category->title = $request->title;
        $category->lang_id = $request->language;
        $category->parent_id = $parent;
        $category->save();

        Session::flash('success' , 'New Category was added successfuly');

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
