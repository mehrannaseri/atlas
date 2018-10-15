@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Add New Post</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="http://localhost/kubak.co/panel/newnews/add" enctype="multipart/form-data">
                    <input id="csrf_test_name" name="csrf_test_name" value="7eabd734b9300573e507d0a8fd7bd567" type="hidden">
                    <input name="update" value="0" type="hidden">
                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Post Language</label>
                            <select onchange="setDir(this.value,['body'])" class="form-control" name="language" >
                                <option value="0" selected hidden disabled="">Select language</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Title</label>
                            <input class="form-control" value="" name="title" id="exampleInputEmail1" placeholder="Enter title" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Category</label>
                            <select class="form-control select2" name="category" multiple>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Source Name</label>
                            <input class="form-control" value="" name="src_title" id="exampleInputEmail1" placeholder="Enter Source name" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Source Link</label>
                            <input class="form-control" value="" name="src_anchor" id="exampleInputEmail1" placeholder="Enter Source link" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputFile">News Image</label>
                            <input name="img" id="exampleInputFile" type="file">
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop

