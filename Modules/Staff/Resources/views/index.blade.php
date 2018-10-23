@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Staff list</h1>
@stop


@section('content')
    @if(auth()->user()->hasRole('admin') || auth()->user()->can('create staff'))
        <a href="{{route('add')}}" class="btn btn-success">Add New Staff</a>
    @endif

    @include('layouts.message')
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Last name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date of employeement</th>
                        <th>Avatar</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        ?>
                        @foreach($users as $user)
                            <tr class="{{($user->id === auth()->user()->id ? 'active' : '')}}">
                                <td>{{$counter}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lname}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <label class="label label-{{($user->roles[0]->name == 'admin' ? 'success' : 'info')}}">{{$user->roles[0]->name}}</label>
                                </td>
                                <td>{{$user->created_at->format('Y-m-d')}}</td>
                                <td>
                                    @if($user->avatar !== null)
                                        <img class="img-circle img-sm" src="{{asset($user->avatar)}}" />
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->hasRole('admin') || auth()->user()->can('update staff'))
                                        <a class="btn-sm btn-success" href="{{asset('panel/staff/edit/'.$user->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                    @endif
                                    @if((!$user->hasRole('admin') && $user->id !== auth()->user()->id) &&
                                     (auth()->user()->hasRole('admin') || auth()->user()->can('destroy staff')))
                                        <a class="btn-sm btn-danger" href="javascript:void(0)" onclick="remove('{{asset('panel/staff/delete/'.$user->id)}}')"><i class="fa fa-trash"></i> Delete</a>
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
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/alertify.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/jquery.rateyo.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/panel/popup.js')}}"></script>
    <script src="{{asset('/js/jquery.rateyo.js')}}"></script>
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

