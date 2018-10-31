@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Messages Detail</h1>
@stop


@section('content')

    <section class="content container-fluid">

        <div class="box box-info">
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>id</td>
                            <td>{{$message->id}}</td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td>{{$message->fullname}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$message->email}}</td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td><p style="white-space:pre-wrap;">{{$message->message}}</p></td>
                        </tr>
                        <tr>
                            <td>Sent at :</td>
                            <td>{{$message->created_at}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-3"></div>
            </div>

        </div>
    </section>
@stop
