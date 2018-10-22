@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')

@stop

@section('content')
    <div class="content-wrapper" style="min-height: 1125.9px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                403 Error Page
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="error-page">
                <h2 class="headline text-red">403</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-red"></i> Access Denied! </h3>

                    <p>
                        Your access to this page is denied,Sorry!
                        Meanwhile, you may <a href="{{route('dashboard')}}">return to dashboard</a> or try using the search form.
                    </p>

                </div>
            </div>
            <!-- /.error-page -->

        </section>
        <!-- /.content -->
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