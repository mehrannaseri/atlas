@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Category Management</h1>
@stop

@section('content')
    <button data-toggle="modal" data-target="#modal-category" class="btn btn-success">Add New Category</button>

    @if(!empty($errors->first()))
        <div id="message_alert" class="alert alert-danger" role="alert">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif
    @if (Session::has('success'))
        <div id="message_alert" class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('delete'))
        <div id="message_alert" class="alert alert-warning">{{ Session::get('delete') }}</div>
    @endif
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Language</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <!------------------  categorymodal ------------------->
        <div class="modal fade" id="modal-category" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add new category</h4>
                    </div>
                    <div class="modal-body">
                        <form id="modal_form" action="{{asset('panel/post/category/add')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <select onchange="parentByLang(this.value)" name="language" id="language" class="form-control">
                                    <option selected hidden disabled="" value="">Select language</option>
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="title" id="title" placeholder="" type="text">
                            </div>
                            <div class="form-group">
                                <select name="parent" id="parent" class="form-control">
                                    <option selected hidden disabled="" value="">Select parent</option>
                                </select>
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
        <!---------------------- / category modal----------------------->
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
        var reqUrl = '{{asset('panel/post/')}}';
        var token = '{{csrf_token()}}';
    </script>
    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop

