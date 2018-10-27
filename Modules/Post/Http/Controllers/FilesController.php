<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\File;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function postFiles()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create post')){
            $images = File::where('type' , 'jpg')->orderBy('created_at','desc')->get();
            $videos = File::where('type' , 'mp4')->orderBy('created_at','desc')->get();
            $files = File::where('type' , 'pdf')->orderBy('created_at','desc')->get();

            return view('post::files' , compact('files','images','videos'));
        }
        else{
            return view('layouts.error.404');
        }

    }

    public function UploadFilePost(Request $request)
    {

        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create post')){
            $request->validate([
                'files.*' => 'mimes:jpeg,png,bmp,mp4,mkv,wmv,avi,mov,pdf,doc,docx,ppt,pptx,txt',
                'files'   => 'required'

            ]);

            $files = $request->file('files');
            foreach($files as $file)
            {
                $file_ext = $file->getClientOriginalExtension();
                $ext = $this->EXTFile($file_ext);

                $name= time().$file->getClientOriginalName();
                $file->move(public_path().'/files/posts/', $name);
                $path = '/files/posts/'.$name;

                $file = new File();
                $file->file_url = $path;
                $file->type = $ext;
                $file->save();
                // $data[] = $file->id;
            }
            Session::flash('success' , 'New files was added successfuly!');
            return back();
        }
        else{
            return view('layouts.error.403');
        }

    }

    public function deleteFile($id)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('create post')){
            $file = File::find($id);

            unlink(public_path().'/'.$file->file_url);
            $file->posts()->detach();
            $file->delete();

            Session::flash('delete' , 'The selected file was deleted successfully');
            return back();


        }
        else{
            return view('layouts.error.403');
        }

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

    public function filterFile(Request $request)
    {
        $filter_date = $request->fil;
        $date = \Carbon\Carbon::today();
        $tom = \Carbon\Carbon::tomorrow();
        switch($filter_date){
            case "today" :
                $files = File::where('created_at', ">=", $date)->where('type' , 'jpg')->get();
            break;
            case "week" :
                $end = \Carbon\Carbon::today()->subDays(7);
                $files = File::whereBetween('created_at', array($end, $tom))->where('type' , 'jpg')->get();
            break;
            case "month" :
                $end = \Carbon\Carbon::tomorrow()->subDays(30);
                $files = File::whereBetween('created_at', array($end, $tom))->where('type' , 'jpg')->get();
            break;
            case "year" :
                $end = \Carbon\Carbon::today()->subYear(1);
                $files = File::whereBetween('created_at', array($end, $tom))->where('type' , 'jpg')->get();
            break;
        }

        return view('post::layouts.filterFile' , compact('files'));
    }
}
