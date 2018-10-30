@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Exhibition list</h1>
@stop


@section('content')
    @if(auth()->user()->hasRole('admin') || auth()->user()->can('create exhibition'))
        <a href="{{route('exhibition::add')}}" class="btn btn-success">Add New Exhibition</a>
    @endif

    @include('layouts.message')
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Language</th>
                        <th>province-City </th>
                        <th>Holding date</th>
                        <th>Registration time</th>
                        <th>Cost per meter</th>
                        <th>Status</th>
                        <th>Customers</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $counter = 1;
                            ?>
                    @foreach($exhibitions as $exib)
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$exib->title}}</td>
                            <td>{{$exib->lang->title}}</td>
                            <td>{{$exib->state->title.' - '.$exib->city->title}}</td>
                            <td>{{$exib->start_holding.' to '.$exib->end_holding}}</td>
                            <td>{{$exib->start_reg.' to '.$exib->end_reg}}</td>
                            <td>{{number_format($exib->cpm)}}</td>
                            <td>{!! ExibStatus($exib->start_holding,$exib->end_holding , $exib->start_reg , $exib->end_reg) !!}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!------------------  modal ------------------->
        <div class="modal fade" id="modal" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Post images</h4>
                    </div>
                    <div  class="modal-body col-md-12 col-sm-12">
                        <div id="show_img" style="max-height: 500px ; overflow: scroll">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">close</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!---------------------- /  modal----------------------->
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/alertify.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/labelify.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/panel/popup.js')}}"></script>
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
                'searching'   : false,
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

