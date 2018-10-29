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
                <form role="form" action="{{asset('/panel/post/store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="old_files" value="" name="old_files"/>

                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Post Language</label>
                            <select onchange="setDir(this.value,['body','title'])" class="form-control" name="language" >
                                <option value="0" selected hidden disabled="">Select language</option>
                                @foreach($languages as $language)
                                    <option {{(old('language') == $language->id ? 'selected' : '')}} value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Title</label>
                            <input class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Enter title" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Category</label>
                            <select class="form-control select2" id="category" name="category[]" multiple>
                               <option hidden disabled="">Please select language</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Tags</label>
                            <select class="form-control select2" id="tag" name="tag[]" multiple>
                                <option hidden disabled="">Please select language</option>
                            </select>
                        </div>
                        <div  class="form-group col-md-12 col-xs-12">

                            <div class="form-group col-md-3 col-xs-3">
                                <div class="upload-btn-wrapper">
                                    <input type="button" value="Use uploaded images" data-toggle="modal" data-target="#modal" class="btn1" />
                                </div>
                            </div>
                            <list style="display: none" class="old_file alert-info" id="old_count_files"></list>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label for="exampleInputFile">Post body</label>
                            <a class="btn  btn-default myinsertFile" title="Insert file" data-toggle="modal" data-target="#myModal"  href="javascript:void(0);" >
                                <span class="glyphicon glyphicon-picture"></span>
                            </a>
                            <!--<input type="hidden" id="textBody" name="body" value="{{old('body')}}">-->
                            <textarea dir="ltr" id="body" name="body" class="textarea" placeholder="Place some text here"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{old('body')}}
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
                    <list class="new_file alert-info"><span id="counter">0</span> file selected</list>
                    <div  class="modal-body col-md-12 col-sm-12">
                        Filter Uploaded Files in : <br><br>
                        <button onclick="Filter(this,'today')" class="filter btn btn-sm btn-primary">Today</button>
                        <button onclick="Filter(this,'week')" class="filter btn btn-sm btn-primary">Last week</button>
                        <button onclick="Filter(this,'month')" class="filter btn btn-sm btn-primary">Last Month</button>
                        <button onclick="Filter(this,'year')" class="filter btn btn-sm btn-primary">Last Year</button>
                        <button onclick="Filter(this,'')" class="filter btn btn-sm btn-success">Reset</button>
                        <div id="loader" style="display: none" class="Loader">
                            <div class="Bar"></div>
                            <div class="Bar"></div>
                            <div class="Bar"></div>
                            <div class="Bar"></div>
                            <div class="Bar"></div>
                            <div class="Bar"></div>
                        </div>
                        <div id="result" style="min-height:500px; max-height: 500px ; overflow: scroll">
                            @foreach($files as $file)
                                <div class="col-md-5 col-sm-5">
                                    <div class=" checkbox rounded-6 medium m-b-2">
                                        <div class=" checkbox-overlay">
                                            <input type="checkbox" onchange="useImage(this,{{$file->id}})" id="myCheckbox1" />
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

        <!-- Modal file in text-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                        </button>
                        <h4 class="modal-title" id="myModalLabel">Select file</h4>

                    </div>
                    <div class="modal-body">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Image</a>

                                </li>
                                <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Video</a>

                                </li>
                                <li role="presentation"><a href="#uploadNew" aria-controls="uploadNew" role="tab" data-toggle="tab">Upload New</a>

                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                    <div id="" style="min-height:500px; max-height: 500px ; overflow: scroll">
                                        @foreach($files as $file)
                                            <div class="col-md-5 col-sm-5">
                                                <div class=" checkbox rounded-6 medium m-b-2">
                                                    <div class=" checkbox-overlay">
                                                        <input type="checkbox" onchange="useFileInText(this,'{{asset($file->file_url)}}','img')" id="myCheckbox1" />
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
                                <div role="tabpanel" class="tab-pane" id="browseTab">
                                    <div id="" style="min-height:500px; max-height: 500px ; overflow: scroll">
                                        @foreach($videos as $video)
                                            <div class="col-md-5 col-sm-5">
                                                <div class=" checkbox rounded-6 medium m-b-2">
                                                    <div class=" checkbox-overlay">
                                                        <input type="checkbox" onchange="useFileInText(this,'{{asset($video->file_url)}}','mov')" id="myCheckbox1" />
                                                        <div class="checkbox-img checkbox-container">
                                                            <div class="checkbox-checkmark"></div>
                                                        </div>
                                                        <label for="myCheckbox1">
                                                            <video class="videoArea" width="320" height="240">
                                                                <source src="{{asset($video->file_url)}}" type="video/mp4">
                                                                <source src="{{asset($video->file_url)}}" type="video/ogg">
                                                                Your browser does not support the video .
                                                            </video>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="uploadNew">
                                    <br>
                                    <form id="modal_form" action="{{asset('panel/post/files/add')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="output" value="path" />
                                        <div class="form-group">
                                            <div class="upload-btn-wrapper">
                                                <button class="btn1">Upload new file</button>
                                                <input type="file" id="file_select" name="files[]" onchange="CountSelected('send')" />
                                            </div>
                                        </div>
                                        <list style="display: none" class="new_file alert-info" id="count_files"></list>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
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
        @if(old('language') !== null)
            setDir('{{old('language')}}',['body','title'])
        @endif
    </script>

@stop

