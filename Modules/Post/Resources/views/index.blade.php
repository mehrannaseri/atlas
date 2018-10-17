@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>News list</h1>
@stop

@section('content')

    <a href="{{route('add')}}" class="btn btn-success">Add New Post</a>

    @include('layouts.message')
    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Language</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th>Rate</th>
                        <th>Create Date</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                    ?>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->lang->title}}</td>
                            <td>
                                <ul class="tags1">
                                    @foreach($post->categories as $category)
                                        <li><a href="#">{{$category->title}}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul class="tags">
                                    @foreach($post->tags as $tag)
                                        <li><a href="#">{{$tag->title}}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a class="tooltips" href="#">

                                    <div class="rating-box">
                                        {{rate($post->rates)}}
                                    </div>
                                    <i>sdsfdf</i>
                                </a>
                            </td>
                            <td>Create Date</td>
                            <td>Images</td>
                            <td>Action</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/panel/alertify.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $("#message_alert").slideUp()
            },3500);
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
        var reqUrl = '{{asset('panel/post/')}}';
        var token = '{{csrf_token()}}';
    </script>
    <script src="{{asset('/js/panel/alertify.min.js')}}"></script>
    <script src="{{asset('/js/panel/custom.js')}}"></script>
@stop

