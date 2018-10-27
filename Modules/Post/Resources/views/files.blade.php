@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Category Management</h1>
@stop

@section('content')
    @if(auth()->user()->hasRole('admin') || auth()->user()->can('create post'))
        <button data-toggle="modal" onclick="show_modal('{{asset('panel/post/files/add')}}')" data-target="#modal" class="btn btn-success">Add New Category</button>
    @endif
    @include('layouts.message')
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>path</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                    ?>
                    @foreach($files as $file)
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$file->file_url}}</td>
                            <td>
                                @if(auth()->user()->hasRole('admin') || auth()->user()->can('create post'))
                                    <a href="javascript:void(0)" onclick="remove('{{asset('panel/post/files/remove/'.$file->id)}}')" class="btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                @endif
                            </td>
                        </tr>
                        <?php
                        $counter++;
                        ?>
                    @endforeach
                    </tbody>

                </table>
            </div>
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
                        <form id="modal_form" action="{{asset('panel/post/files/add')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group col-md-3 col-xs-3">
                                <div class="upload-btn-wrapper">
                                    <button class="btn1">Upload new images</button>
                                    <input type="file"  onchange="CountSelected()" id="file_select" name="files[]" multiple />
                                </div>
                            </div>
                            <list style="display: none" class="new_file alert-info" id="count_files"></list>
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

