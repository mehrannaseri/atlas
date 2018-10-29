@extends('adminlte::page')

@section('title', 'Atlas panel')

@section('content_header')
    <h1>Add New Exhibition</h1>
@stop

@section('content')

    <section class="content container-fluid">

        <div class="box box-info">
            <div class="box">
                @include('layouts.message')
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{asset('/panel/post/store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="old_files" value="" name="old_files"/>

                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Language</label>
                            <select onchange="setDir(this.value,['exhibition','title'])" class="form-control" name="language" >
                                <option value="0" selected hidden disabled="">Select language</option>
                                @foreach($languages as $language)
                                    <option {{(old('language') == $language->id ? 'selected' : '')}} value="{{$language->id}}">{{$language->title.' ( '.$language->flag.' )'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Title</label>
                            <input class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Enter title" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Province of the venue</label>
                            <select onchange="" class="form-control" name="state" >
                                <option value="0" selected hidden disabled="">Select State</option>
                                @foreach($states as $state)
                                    <option {{(old('state') == $state->id ? 'selected' : '')}} value="{{$state->id}}">{{$state->title}}</option>
                                @endforeach
                            </select>
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
    <link rel="stylesheet" href="{{asset('/css/panel/bootstrap3-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{asset('/css/panel/beautiful-checkbox.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/panel/bootstrap3-wysihtml5.all.js')}}"></script>
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
            $('.textarea').wysihtml5()
        });
        var reqUrl = '{{asset('panel/post/')}}';
        var publicUrl = '{{asset('panel/language')}}';
        var token = '{{csrf_token()}}';
    </script>

    <script src="{{asset('/js/panel/custom.js')}}"></script>
    <script>
        @if(old('language') !== null)
            setDir('{{old('language')}}',['exhibition','title'])
        @endif
    </script>

@stop

