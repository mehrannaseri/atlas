@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>System roles</h1>
@stop

@section('content')
    @if(auth()->user()->hasRole('admin'))
        <button data-toggle="modal" onclick="show_modal('{{asset('panel/staff/role/add')}}')" data-target="#modal" class="btn btn-success">Add New Role</button>
    @endif
    @include('layouts.message')
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        <th>User</th>
                        <th>Creayed At</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                    ?>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <ul class="tags1">
                                    @if(sizeof($role->users) > 3)
                                        <div id="popup-window{{$role->id}}" class="popup-window">
                                            <div class="popup-close x-close">&times;</div>
                                            @foreach($role->users as $user)
                                                <li class="li-pop"><a href="#">{{$user->name}}</a></li>
                                            @endforeach
                                        </div>
                                        <li><a href="#">{{$role->users[0]['name']}}</a></li>
                                        <li><a href="#">{{$role->users[1]['name']}}</a></li>
                                        <li><a href="#" id="{{$role->id}}" class="popup-trigger">&bull;&bull;&bull;</a></li>
                                    @else
                                        @foreach($role->users as $user)
                                            <li><a href="#">{{$user->name}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td>{{$role->created_at->format('Y-m-d')}}</td>
                            <td>
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="javascript:void(0)" onclick="editRole({{$role}})" data-toggle="tooltip" class="btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>&nbsp;
                                @endif&nbsp;
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="javascript:void(0)" onclick="remove('{{asset('panel/staff/role/delete/'.$role->id)}}')" data-toggle="tooltip"  class="btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
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
        <!------------------  tag modal ------------------->
        <div class="modal fade" id="modal" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add new Role</h4>
                    </div>
                    <div class="modal-body">
                        <form id="modal_form" action="{{asset('panel/staff/role/add')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" placeholder="Role name" type="text">
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
    <script src="{{asset('/js/panel/popup.js')}}"></script>
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
        var reqUrl = '{{asset('panel/staff/')}}';
        var token = '{{csrf_token()}}';
    </script>
    <script src="{{asset('/js/panel/alertify.min.js')}}"></script>
    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop

