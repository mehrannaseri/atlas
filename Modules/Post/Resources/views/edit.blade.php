@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Add New Post</h1>
@stop

@section('content')

    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                @include('layouts.message')
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{asset('/panel/post/update/'.$post->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="old_files" value="" name="old_files"/>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Post Language</label>
                            <select onchange="setDir(this.value,['body','title'])" class="form-control" name="language" >
                                <option value="0" selected hidden disabled="">Select language</option>
                                @foreach($languages as $language)
                                    <option {{$language->id == $post->lang_id ? 'selected' : ''}} value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Title</label>
                            <input class="form-control" value="{{$post->title}}" name="title" id="title" placeholder="Enter title" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Category</label>
                            <select class="form-control select2" id="category" name="category[]" multiple>
                                @foreach($post->categories as $category)
                                    <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Tags</label>
                            <select class="form-control select2" id="tag" name="tag[]" multiple>
                                @foreach($post->tags as $tag)
                                    <option value="{{$tag->id}}" selected>{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="form-group col-md-12 col-xs-12">
                            <div class="form-group col-md-3 col-xs-3">
                                <div class="upload-btn-wrapper">
                                    <button class="btn1">Upload new images</button>
                                    <input type="file" accept="image/jpeg,image/png" onchange="CountSelected()" id="file_select" name="files[]" multiple />
                                </div>
                            </div>
                            <list style="display: none" class="new_file alert-info" id="count_files"></list>
                            <div class="form-group col-md-3 col-xs-3">
                                <div class="upload-btn-wrapper">
                                    <input type="button" value="Use uploaded images" data-toggle="modal" data-target="#modal" class="btn1" />
                                </div>
                            </div>
                            <list style="" class="old_file alert-info" id="old_count_files">{{sizeof($post->files)}} files selected</list>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label for="exampleInputFile">Post body</label>
                            <textarea dir="ltr" id="body" class="textarea" name="body" placeholder="Place some text here"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$post->body}}
                                </textarea>
                        </div>
                    </div>

                    <div class="box-footer ">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!------------------  modal ------------------->
        <div class="modal fade" id="modal" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Select image</h4>
                    </div>
                    <br>
                    <list class="new_file alert-info"><span id="counter">{{sizeof($post->files)}}</span> file selected</list>
                    <div  class="modal-body col-md-12 col-sm-12">
                        <div style="max-height: 500px ; overflow: scroll">
                            @foreach($files as $file)
                                <div class="col-md-5 col-sm-5">
                                    <div class=" checkbox rounded-6 medium m-b-2">
                                        <div class=" checkbox-overlay">
                                            <input type="checkbox"
                                                   @foreach($post->files as $pfile)
                                                        @if($pfile->id === $file->id)
                                                           {{'checked'}}
                                                        @endif
                                                   @endforeach
                                                   onchange="useImage(this,{{$file->id}})" id="myCheckbox1" />
                                            <div class="checkbox-img checkbox-container">
                                                <div class="checkbox-checkmark"></div>
                                            </div>
                                            <label for="myCheckbox1"><img class="tumb-img" width="250" height="200" src="{{asset($file->file_url)}}"></label>

                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">close</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!---------------------- /  modal----------------------->
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/bootstrap3-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{asset('/css/panel/beautiful-checkbox.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/panel/bootstrap3-wysihtml5.all.js')}}"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $("#message_alert").slideUp()
            },3500);
        });
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(function () {
            $('.textarea').wysihtml5()
        });
        var reqUrl = '{{asset('panel/post/')}}';
        var token = '{{csrf_token()}}';

    </script>

    <script src="{{asset('/js/panel/custom.js')}}"></script>
    <script>
        setDir('{{$post->lang_id}}' , ['body','title'],true);
    </script>
    @foreach($post->files as $file)
        <script>
            old_files.push({{$file->id}})
        </script>
    @endforeach
    <script>
        document.getElementById("old_files").value = old_files;
    </script>
@stop

