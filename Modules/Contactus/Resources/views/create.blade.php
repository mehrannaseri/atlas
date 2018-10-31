@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Messages list</h1>
@stop


@section('content')

    <section class="content container-fluid">

        <div class="box box-info">
        <div class="form-group">
            <form action="{{URL::asset('panel/contactus/save')}}" method="post">
                {{csrf_field()}}
            <input type="text" name="fullname" class="form-control">
            <input type="email" name="email" class="form-control">
            <textarea name="message">

            </textarea>
                <input type="submit" class="btn btn-success" value="send">
            </form>
        </div>
        </div>
    </section>
    <div class="modal modal-success fade" id="modal-success" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Success </h4>
                </div>
                <div class="modal-body">
                    @if(Session::has('success'))
                        <p>{{Session::get('success')}}</p>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('js')
    @if(Session::has('success'))
    <script type="text/javascript">

        $(function() {
            $('#modal-success').modal('show');
        });
    </script>
    @endif
@stop