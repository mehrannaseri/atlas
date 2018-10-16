@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Tags Management</h1>
@stop

@section('content')

    <button data-toggle="modal" onclick="show_modal()" data-target="#modal" class="btn btn-success">Add New Tag</button>

    @if(!empty($errors->first()))
        <div id="message_alert" class="alert alert-danger" role="alert">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif
    @if (Session::has('success'))
        <div id="message_alert" class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('delete'))
        <div id="message_alert" class="alert alert-warning">{{ Session::get('delete') }}</div>
    @endif
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Language</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                    ?>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$tag->title}}</td>
                            <td>{{$tag->lang->title}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="editCategory({{$tag}})" class="btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                <a href="javascript:void(0)" onclick="remove('{{asset('panel/post/category/remove/'.$tag->id)}}')" class="btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
        <!------------------  tag modal ------------------->
        <div class="modal fade" id="modal" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add new Tag</h4>
                    </div>
                    <div class="modal-body">
                        <form id="modal_form" action="{{asset('panel/post/tag/add')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <select name="language" id="language" class="form-control">
                                    <option selected hidden disabled="" value="">Select language</option>
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="title" id="title" placeholder="" type="text">
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
        <!---------------------- / tag modal----------------------->
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

