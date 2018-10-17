@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Add New Post</h1>
@stop

@section('content')

    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                @if(!empty($errors->first()))
                    <div id="message_alert" class="alert alert-danger" role="alert">
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{asset('/panel/post/store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" value="" name="old_files[]"/>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Post Language</label>
                            <select onchange="setDir(this.value,['body','title'])" class="form-control" name="language" >
                                <option value="0" selected hidden disabled="">Select language</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
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
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="form-group col-md-3 col-xs-3">
                                <div class="upload-btn-wrapper">
                                    <button class="btn1">Upload new images</button>
                                    <input type="file" onchange="CountSelected()" id="file_select" name="files[]" multiple />
                                </div>
                            </div>
                            <list style="display: none" class="new_file alert-info" id="count_files"></list>
                            <div class="form-group col-md-3 col-xs-3">
                                <div class="upload-btn-wrapper">
                                    <input type="button" value="Use uploaded images" data-toggle="modal" onclick="show_modal()" data-target="#modal" class="btn1" />
                                </div>
                            </div>
                            <list style="display: none" class="old_file alert-info" id="old_count_files"></list>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label for="exampleInputFile">Post body</label>
                            <textarea dir="ltr" id="body" class="textarea" name="body" placeholder="Place some text here"
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
                        <h4 class="modal-title">Add new language</h4>
                    </div>
                    <div class="modal-body">
                        <form id="modal_form" action="{{asset('panel/language')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input class="form-control" name="language" id="language" placeholder="Language Title: English , kurdish" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" maxlength="2" name="flag" id="flag" placeholder="Language flag : en , ku" type="text">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/panel/bootstrap3-wysihtml5.all.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(function () {
            $('.textarea').wysihtml5()
        });
        var reqUrl = '{{asset('panel/post/')}}';
        var token = '{{csrf_token()}}';
        var old_files = [];
    </script>

    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop

