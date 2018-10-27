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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('read post')) {
            $posts = Post::with('lang')
                ->with('categories')
                ->with('tags')
                ->with('files')
                ->orderBy('created_at' , 'desc')
                ->get();
            return view('post::index', compact('posts'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    public function create()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create post')) {
            $languages = Language::all();
            $files = File::where('type' , 'jpg')->get();

            return view('post::create', compact('languages', 'files'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    public function setDir(Request $request)
    {
        return Language::with('tags')->with('categories')->where('id' , $request->lang)->get();
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create post')) {
            $request->validate([
                'language' => 'required',
                'title' => 'required',
                'category' => 'required',
                'old_files' => 'required',
            ], [
                'old_files.required' => 'Selecting at least one new file or selecting from previous files is essential'
            ]);

            $post = $this->AddPost($request);

            $post->categories()->attach($request->category);

            if ($request->has('tag')) {
                $post->tags()->attach($request->tag);
            }
            if ($request->old_files != "") {
                $files = explode(",", $request->old_files);
                $this->addFilePost($post->id, $files);
            }

            /*if ($request->hasfile('files')) {

                $data = $this->UploadFilePost($request->file('files'));

                $this->addFilePost($post->id, $data);
            }*/

            Session::flash('success', 'New Post added successfuly');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

    protected function AddPost($request,$post = null)
    {
        if($post == null) {
            $post = new Post();
        }
        $post->title = $request->title;
        $post->lang_id = $request->language;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->save();

        return $post;
    }

    protected function EXTFile($ext)
    {
        $type = "";
        switch($ext){
            case "jpg":
            case "png":
            case "bmp":
                $type = 'jpg';
            break;

            case "mp4" :
            case "mkv":
            case "wmv":
            case "avi":
            case "mov":
                $type = "mp4";
            break;

            case "pdf":
            case "doc":
            case "docx":
            case "ppt":
            case "pptx":
            case "txt":
                $type = "pdf";
            break;
        }
        return $type;
    }

    protected function addFilePost($id,$data)
    {
        $post = Post::find($id);
        $post->files()->attach($data);
    }

    public function edit($id)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('update post')) {
            $languages = Language::all();
            $files = File::all();
            $post = Post::where('id', $id)
                ->with('categories')
                ->with('tags')
                ->with('files')
                ->first();

            return view('post::edit', compact('post', 'languages', 'files'));
        }
        else{
            return view('layouts.error.404');
        }
    }

    public function update($id,Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('update post')) {
            $request->validate([
                'language' => 'required',
                'title' => 'required',
                'files.*' => 'required_if:old_files,|mimes:jpeg,png',
                'old_files' => 'required_if:files,',
            ], [
                'files.required_if' => 'Selecting at least one new file or selecting from previous files is essential',
                'old_files.required_if' => 'Selecting at least one new file or selecting from previous files is essential'
            ]);

            $post = Post::find($id);
            $this->AddPost($request, $post);

            if ($request->has('category')) {
                $post->categories()->detach();
                $post->categories()->attach($request->category);
            }
            if ($request->has('tag')) {
                $post->tags()->detach();
                $post->tags()->attach($request->tag);
            }

            $post->files()->detach();
            if ($request->old_files != "") {
                $files = explode(",", $request->old_files);
                $this->addFilePost($post->id, $files);
            }
            if ($request->hasfile('files')) {
                $data = $this->UploadFilePost($request->file('files'));
                $this->addFilePost($post->id, $data);
            }

            Session::flash('success', 'Post was updated successfuly');
            return redirect()->route('list');
        }
        else{
            return view('layouts.error.403');
        }

    }
    public function destroy($id)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('destroy post')) {
            $post = Post::find($id);
            $post->categories()->detach();
            $post->files()->detach();
            $post->tags()->detach();
            $post->comments()->delete();
            $post->rates()->delete();
            $post->delete();

            Session::flash('delete', 'Post was deleted successfuly');
            return back();
        }
        else{
            return view('layouts.error.403');
        }
    }

}
