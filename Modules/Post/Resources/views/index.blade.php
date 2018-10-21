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
            <div class="box table-responsive">
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
                                    @if(sizeof($post->categories) > 3)
                                        <div id="popup-window{{'C'.$post->id}}" class="popup-window">
                                            <div class="popup-close x-close">&times;</div>
                                            @foreach($post->categories as $cat)
                                                <li class="li-pop"><a href="#">{{$cat->title}}</a></li>
                                            @endforeach
                                        </div>

                                        <li><a href="#">{{$post->categoris[0]['title']}}</a></li>
                                        <li><a href="#">{{$post->categories[1]['title']}}</a></li>
                                        <li><a href="#" id="{{'C'.$post->id}}" class="popup-trigger">&bull;&bull;&bull;</a></li>
                                    @else
                                        @foreach($post->categories as $cat)
                                            <li><a href="#">{{$cat->title}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <ul class="tags">
                                    @if(sizeof($post->tags) > 3)
                                        <div id="popup-window{{$post->id}}" class="popup-window">
                                            <div class="popup-close x-close">&times;</div>
                                            @foreach($post->tags as $tag)
                                                <li class="li-pop"><a href="#">{{$tag->title}}</a></li>
                                            @endforeach
                                        </div>

                                        <li><a href="#">{{$post->tags[0]['title']}}</a></li>
                                        <li><a href="#">{{$post->tags[1]['title']}}</a></li>
                                        <li><a href="#" id="{{$post->id}}" class="popup-trigger">&bull;&bull;&bull;</a></li>
                                    @else
                                        @foreach($post->tags as $tag)
                                            <li><a href="#">{{$tag->title}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <?php
                                $rateInfo = rate_info($post->rates);
                                ?>
                                <a class="tooltips" href="#">
                                    <div data-rating="{{$rateInfo[0]}}"  id="rateYo{{$counter}}"></div>
                                    <div class="counter"></div>
                                    <i>
                                        {{ $rateInfo[0] }} <span class="fa fa-check-circle"></span>&nbsp; / &nbsp;
                                        {{ $rateInfo[1] }} <span class="fa fa-user"></span>
                                    </i>
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
                                <a href="javascript:void(0)" onclick="remove('{{asset('panel/post/delete/'.$post->id)}}')" data-toggle="tooltip" title="Delete post"  class="btn-sm btn-danger">
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
    <link rel="stylesheet" href="{{asset('/css/jquery.rateyo.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/panel/popup.js')}}"></script>
    <script src="{{asset('/js/jquery.rateyo.js')}}"></script>
    <script>
        var sizePost = '{{sizeof($posts)}}';

        $(document).ready(function(){
            setTimeout(function(){
                $("#message_alert").slideUp()
            },3500);

            $('[data-toggle="tooltip"]').tooltip({
                html: true
            });
        });
            $(function () {
                for(var i = 1; i<= sizePost ; i++) {
                    var rate = $("#rateYo"+i).attr('data-rating');
                    $("#rateYo"+i).rateYo({
                        precision: rate,
                        rating: rate,
                        readOnly: true,
                        maxValue: 5,
                        numStars: 5,
                        multiColor: {

                            "startColor": "#FF0000", //RED
                            "endColor"  : "#f39c12"  //GREEN
                        }
                    });
                }
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

