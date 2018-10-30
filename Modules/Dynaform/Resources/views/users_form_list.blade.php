@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Members</h3>

                    <div class="box-tools pull-right">


                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>user id</td>
                            <td>user ip</td>
                            <td>form date</td>
                            <td>show</td>
                        </tr>
                        @foreach($users as $user)

                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->user_ip}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><a href="{{URL::asset('dynaform/show/form/'.$user->element->form_id.'/user/'.$user->id)}}" class="btn btn-success">show</a></td>
                            </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @stop