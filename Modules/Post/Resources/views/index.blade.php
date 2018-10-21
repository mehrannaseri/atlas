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
                <table id="example2" class="table table-bordered table-hover table-responsive">
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
                                <?php
                                $counter = 1; $title = '';
                                ?>
                                <ul class="tags">
                                    @if(sizeof($post->tags) > 3)
                                        <div class="popup-window">
                                            <div class="popup-close x-close">&times;</div>
                                            @foreach($post->tags as $tag)

                                                <li class="li-pop"><a href="#">{{$tag->title}}</a></li>
                                            @endforeach
                                        </div>

                                        <li><a href="#">{{$post->tags[0]['title']}}</a></li>
                                        <li><a href="#">{{$post->tags[1]['title']}}</a></li>
                                        <li><a href="#" class="popup-trigger">Pop Me</a></li>
                                    @else
                                        @foreach($post->tags as $tag)
                                            <li><a href="#">{{$tag->title}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <a class="tooltips" href="#">

                                    <div class="rating-box">
                                        {!! rate($post->rates) !!}
                                    </div>
                                    <i>{!! rate_info($post->rates) !!} <span class="fa fa-user"></span></i>
                                </a>
                            </td>
                            <td>{{$post->created_at->format('Y-m-d')}}</td>
                            <td>
                                <a href="javascript:void(0)" data-toggle="tooltip" title="View images" onclick="showGallery('{{$post->files}}')" class=" btn-sm btn-info">
                                    <i class="fa fa-photo"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{asset('panel/post/edit/'.$post->id)}}" data-toggle="tooltip" title="Edit post info" class="btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;&nbsp;
                                <a href="{{asset('panel/post/delete/'.$post->id)}}" data-toggle="tooltip" title="Delete post"  class="btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $counter++;
                        ?>
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

