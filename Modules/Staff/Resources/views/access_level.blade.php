@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Change permission</h1>
@stop


@section('content')

    @include('layouts.message')
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box-body">
                <div class="form-group col-md-6 col-xs-6">
                    <label for="exampleInputEmail1">User</label>
                    <select name="user" id="user" onchange="permissionUser(this.value)" class="form-control">
                        <option value="" selected hidden disabled="">Select User</option>
                        @foreach($users as $user)
                            <option data-content="{{$user->permissions}}" {{($user->roles[0]->name === 'admin' ? 'disabled' : '')}} id="{{$user->id}}"  value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6 col-xs-6">
                    <br><br>
                    <span style="display: none" id="message_alert" class="alert alert-danger"></span>
                </div>
                <div class="form-group col-md-12 col-xs-12">
                    @foreach($permissions as $permission)
                        <div class="col-md-3 col-sm-3">
                            <div class=" checkbox rounded-6 medium m-b-2">
                                <div class=" checkbox-overlay">
                                    <input class="atlasPermission" type="checkbox" onchange="permission(this,{{$permission->id}})" id="{{$permission->id}}" />
                                    <div class="checkbox-container">
                                        <div class="checkbox-checkmark"></div>
                                    </div>
                                    <label for="{{$permission->id}}">{{$permission->name}}</label>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-footer ">
                <button type="submit" onclick="saveChanges('{{asset('panel/staff/setPermission')}}')" class="btn btn-info">Save changes</button>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/alertify.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/beautiful-checkbox.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script>

        $(document).ready(function(){
            setTimeout(function(){
                $("#message_alert").slideUp()
            },3500);

            $('[data-toggle="tooltip"]').tooltip({
                html: true
            });
        });
        $(function () {
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false
            })
        });
        var reqUrl = '{{asset('')}}';
        var token = '{{csrf_token()}}';
    </script>
    <script src="{{asset('/js/panel/alertify.min.js')}}"></script>
    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop

