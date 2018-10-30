@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lost Of Added Forms
    <a href="{{URL::asset('panel/dynaform/add')}}" class="btn btn-success">Add New Form</a>
    </h1>
@stop

@section('content')
    <div class="row">

        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Forms List</h3>

                    <div class="box-tools pull-right">


                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable text-center" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Form Id</th>
                                        <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Form Title</th>
                                        <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Shortcut Code </th>
                                        <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Copy To Clip Board</th>
                                        <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Create Date</th>
                                        <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Last Edit</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($forms as $form)
                                    <tr role="row" class="even">
                                        <td>{{$form->id}}</td>
                                        <td><a href="{{URL::asset('panel/dynaform/show/users/'.$form->id)}}">{{$form->title}} {{count($form->elements)}}</a> </td>
                                        <td>
                                            <textarea rows="1" cols="10" id="form_{{$form->id}}">[dynaform={{$form->id}}]</textarea>

                                        </td>
                                        <td>
                                            <input type="button" class="btn btn-info" value="Copy" onclick="myFunction({{$form->id}})">
                                        </td>
                                        <td>{{$form->created_at}}</td>
                                        <td>{{$form->updated_at}}</td>
                                        <td>
                                            <a href="{{URL::asset("panel/dynaform/edit/".$form->id)}}" class="btn btn-success">Edit</a>
                                            <a href="{{URL::asset("panel/dynaform/delete/".$form->id)}}" class="btn btn-danger">Delete</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite"><div>Showing {{($forms->currentpage()-1)*$forms->perpage()+1}} to @if($forms->currentpage()*$forms->perpage()>$forms->total()) {{$forms->total()}} @else {{$forms->currentpage()*$forms->perpage()}} @endif
                                        of  {{$forms->total()}} entries
                                    </div></div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    {{ $forms->links() }}</div></div>
                        </div>





                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function myFunction($id) {
            /* Get the text field */
            var copyText = document.getElementById("form_"+$id);

            /* Select the text field */
            copyText.select();

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Form Shortcut code Copied to Clipboard");
        }
    </script>
@stop


