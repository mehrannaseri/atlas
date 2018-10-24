@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Edit Staff</h1>
@stop
@section('content')
    @if(auth()->user()->hasRole('admin') || auth()->user()->can('read staff'))
        <a href="{{route('add')}}" class="btn btn-success">Staff List</a>
    @endif
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                @include('layouts.message')
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{asset('/panel/staff/edit/'.$user->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Name</label>
                            <input class="form-control" value="{{$user->name}}" name="name" id="name" placeholder="Enter first name" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Family</label>
                            <input class="form-control" value="{{$user->lname}}" name="lname" id="lname" placeholder="Enter last name" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Mobile</label>
                            <input class="form-control" value="{{$user->mobile}}" name="mobile" id="mobile" onkeypress ="return check_number(event,this.id)" placeholder="Enter mobile number" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" value="{{$user->email}}" name="email" id="" placeholder="Enter email" type="email">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Password</label>
                            <input class="form-control" value="{{old('password')}}" name="password" id="" placeholder="Enter password" type="password">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input class="form-control" value="{{old('password_confirmation ')}}" name="password_confirmation" id="" placeholder="Enter password again" type="password">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Role</label>
                            <select name="role" class="form-control">
                                <option selected hidden disabled="">Select role</option>
                                @foreach($roles as $role)
                                    <option {{($user->roles[0]->id== $role->id ? 'selected' : '')}} {{($role['name'] == 'admin' ? 'disabled' : '')}} value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="form-group col-md-6 col-xs-6">
                            <br>
                                <div class="upload-btn-wrapper">
                                    <button class="btn1">Upload avatar</button>
                                    <input type="file" accept="image/jpeg,image/png" onchange="CountSelected()" id="file_select" name="avatar"  />
                                    @if($user->avatar !== null)
                                        <img class="" src="{{asset($user->avatar)}}" width="50" height="50" />
                                    @endif
                                </div>
                            <list style="display: none" class="new_file alert-info" id="count_files"></list>
                        </div>
                    </div>

                    <div class="box-footer ">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
        var reqUrl = '{{asset('panel/post/')}}';
        var token = '{{csrf_token()}}';
    </script>

    <script src="{{asset('/js/panel/custom.js')}}"></script>
    <script src="{{asset('/js/panel/validation.js')}}"></script>
@stop

