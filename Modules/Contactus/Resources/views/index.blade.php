@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Messages list</h1>
@stop


@section('content')

    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Operations</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                        <td>{{$message->id}}</td>
                        <td>{{$message->fullname}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->message}}</td>
                        <td>{{$message->created_at}}</td>
                        <td>@if($message->is_read) <label class="label label-success">Read</label> @else <label class="label label-warning">Unread</label> @endif </td>
                        <td>
                            <a href="{{URL::asset('panel/contactus/message/'.$message->id)}}" class="btn btn-info">Show</a>
                            <a href="{{URL::asset('panel/contactus/delete/message/'.$message->id)}}" class="btn btn-danger">Remove</a>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@stop
