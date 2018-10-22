@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- left col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable ui-sortable">
            <!-- TO DO List -->

            <!-- Map box -->
            @if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('staff') && auth()->user()->can('read language')))
                <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title">Languages management</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('layouts.message')
                    <div class="box-body">
                    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                        <ul class="todo-list ui-sortable">
                            @foreach($languages as $language)
                                <li>
                                    <span class="text">{{$language->title}}</span>
                                    <!-- Emphasis label -->
                                    <small class="col-md-1 label label-default kubak-color"><i class="fa fa-flag"></i> {{$language->flag}}</small>

                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="javascript:void(0)" onclick="editLanguage({{$language->id}},'{{$language->title}}' , '{{$language->flag}}')"><i class="fa fa-edit"></i></a>
                                        &nbsp;
                                        <a href="{{asset('panel/language/remove/'.$language->id)}}"><i class="fa fa-trash-o"></i></a>

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                        <button type="button" data-toggle="modal" onclick="show_modal('{{asset('panel/language')}}')" data-target="#modal" class="btn btn-default pull-left"><i class="fa fa-plus"></i> New</button>
                    </div>
                    <!------------------  language modal ------------------->
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
                    <!---------------------- / language modal----------------------->
                </div>
            @endif
            <!-- /.box -->

        </section>
        <!-- left col -->
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop
@section('js')
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $("#message_alert").slideUp()
            },3500);
        });
        var reqUrl = '{{asset('panel')}}';
    </script>

    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop