@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Files Management</h1>
@stop

@section('content')
    @if(auth()->user()->hasRole('admin') || auth()->user()->can('create post'))
        <button data-toggle="modal" onclick="show_modal('{{asset('panel/post/files/add')}}')" data-target="#modal" class="btn btn-success">Upload New File</button>
    @endif
    @include('layouts.message')
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Images</b> <a class="pull-right">{{number_format(sizeof($images))}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Videos</b> <a class="pull-right">{{number_format(sizeof($videos))}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Files</b> <a class="pull-right">{{number_format(sizeof($files))}}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Images</a></li>
                        <li><a href="#timeline" data-toggle="tab">Videos</a></li>
                        <li><a href="#settings" data-toggle="tab">Files</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="fileManager">
                                @foreach($images as $image)
                                    <img class="fileArea" src="{{asset($image->file_url)}}" >
                                @endforeach
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <div class="fileManager">
                                @foreach($videos as $video)
                                    <video class="videoArea" width="320" height="240" controls>
                                        <source src="{{asset($video->file_url)}}" type="video/mp4">
                                        <source src="{{asset($video->file_url)}}" type="video/ogg">
                                        Your browser does not support the video .
                                    </video>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <div class="fileManager">
                                @foreach($files as $file)
                                    <li class="extra">
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                        <div class="mailbox-attachment-info">
                                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>{{fileName($file->file_url)}}</a>
                                            <span class="mailbox-attachment-size">
                                              {{file_size($file->file_url)}} KB
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!------------------  categorymodal ------------------->
        <div class="modal fade" id="modal" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add new file</h4>
                    </div>
                    <div class="modal-body">
                        <form id="modal_form" action="{{asset('panel/post/files/add')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="upload-btn-wrapper">
                                    <button class="btn1">Upload new files</button>
                                    <input type="file"  onchange="CountSelected()" id="file_select" name="files[]" multiple />
                                </div>
                            </div>
                            <list style="display: none" class="new_file alert-info" id="count_files"></list>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!---------------------- / category modal----------------------->
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/alertify.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
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
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false
            })
        });
        var reqUrl = '{{asset('panel/post/')}}';
        var token = '{{csrf_token()}}';
    </script>
    <script src="{{asset('/js/panel/alertify.min.js')}}"></script>
    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop

