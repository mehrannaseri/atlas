<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\File;
use Modules\Post\Entities\Language;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\Tag;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $posts = Post::with('lang')
                ->with('categories')
                ->with('tags')
                ->with('files')
                ->get();
       return view('post::index' , compact('posts'));
    }

    public function create()
    {
        $languages = Language::all();
        $files = File::all();

        return view('post::create' , compact('languages','files'));
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
           'files'       => 'required_if:old_files,|mimes:jpeg,png',
           'old_files'   => 'required_if:files,',
        ],[
            'files.required_if'     => 'Selecting at least one new file or selecting from previous files is essential',
            'old_files.required_if' => 'Selecting at least one new file or selecting from previous files is essential'
        ]);

        $post = $this->AddPost($request);

        $post->categories()->attach($request->category);

        if($request->has('tag')){
            $post->tags()->attach($request->tag);
        }
        if($request->old_files != ""){
            $files = explode(",",$request->old_files);
            $this->addFilePost($post->id,$files);
        }

        if($request->hasfile('files'))
        {

            $data = $this->UploadFilePost($request->file('files'));

            $this->addFilePost($post->id,$data);
        }

        Session::flash('success' , 'New Post added successfuly');
        return back();
    }

    protected function AddPost($request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->lang_id = $request->language;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->save();

        return $post;
    }

    protected function UploadFilePost($files)
    {
        foreach($files as $file)
        {
            $name= time().$file->getClientOriginalName();
            $file->move(public_path().'/files/posts/', $name);
            $path = '/files/posts/'.$name;

            $file = new File();
            $file->file_url = $path;
            $file->save();
            $data[] = $file->id;
        }
        return $data;
    }

    protected function addFilePost($id,$data)
    {
        $post = Post::find($id);
        $post->files()->attach($data);
    }

    public function edit($id)
    {
        $languages = Language::all();
        $files = File::all();
        $post = Post::where('id' , $id)
            ->with('categories')
            ->with('tags')
            ->with('files')
            ->first();
        return view('post::edit' , compact('post','languages' , 'files'));
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
