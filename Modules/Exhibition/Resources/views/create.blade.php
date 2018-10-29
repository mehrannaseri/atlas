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
                <form role="form" action="{{asset('/panel/exhibition/store')}}" method="post">
                    {{csrf_field()}}

                    <div class="box-body">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Language</label>
                            <select onchange="setDir(this.value,['exhibition','title','address'])" class="form-control" name="language" >
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
                            <select onchange="CityOfState(this.value)" class="form-control" name="state" >
                                <option value="0" selected hidden disabled="">Select State</option>
                                @foreach($states as $state)
                                    <option {{(old('state') == $state->id ? 'selected' : '')}} value="{{$state->id}}">{{$state->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Exhibition venue city</label>
                            <select id="city" class="form-control" name="city" >
                                <option value="0" selected hidden disabled="">Select City</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Date of holding the exhibition</label>
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" name="start_holding" />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input-sm form-control" name="end_holding" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputPassword1">Registration time at the exhibition</label>
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" name="start_reg" />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input-sm form-control" name="end_reg" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">The number of exhibition booths</label>
                            <input class="form-control" onkeypress ="return check_number(event,this.id)" value="{{old('pavilion_num')}}" name="pavilion_num" id="pavilion_num" placeholder="Enter Number" type="text">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="exampleInputEmail1">Cost per meter exhibit booth</label>
                            <input class="form-control" oninput="money_format(this)" onkeypress ="return check_number(event,this.id)" value="{{old('cpm')}}" name="cpm" id="cpm" placeholder="Enter Cost" type="text">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label for="exampleInputEmail1">Exhibition Address</label>
                            <input class="form-control" value="{{old('address')}}" name="address" id="address" placeholder="Enter Address" type="text">
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
    <link rel="stylesheet" href="{{asset('/css/datePicker.css')}}">
    <link rel="stylesheet" href="{{asset('/css/panel/custom.css')}}">
@stop

@section('js')
    <script src="{{asset('/js/datePicker.js')}}"></script>
    <script src="{{asset('/js/panel/validation.js')}}"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $("#message_alert").slideUp()
            },3500);
        });

        $('.input-daterange').datepicker({
            autoclose: true,
            format : "yyyy-mm-dd",
            startDate: '-d',
        });

        var reqUrl = '{{asset('panel/exhibition/')}}';
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

