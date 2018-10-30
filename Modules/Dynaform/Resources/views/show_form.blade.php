@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <!-- USERS LIST -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Members</h3>

                <div class="box-tools pull-right">


                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
                <div class="form-group">
                    <form method="post" action="{{URL::asset('panel/dynaform/save')}}">
                        {{csrf_field()}}
                        <p>{{$form->title}}</p>
                        @foreach($form->elements as $element)
                            @if(in_array($element->type,['text','email','url','number','tel','file']))
                                <p><label for="">{{$element->title}}</label> <input style="{{$element->style}}" type="{{$element->type}}" name="{{$element->id}}" class="form-control" @if($element->required) required @endif></p>
                            @elseif($element->type=='textarea')
                                <p><label for="{{$element->id}}">{{$element->title}}</label>
                                <textarea class="form-control" id="{{$element->id}}" name="{{$element->id}}">
                                </textarea>
                                </p>
                            @elseif($element->type=='checkbox')
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" style="{{$element->style}}" name="{{$element->id}}"> {{$element->title}}
                                    </label>
                                </div>
                            @else
                                <p class="text-justify">{{$element->title}}</p>
                            @endif
                        @endforeach
                    <button type="submit" class="btn btn-success"> Send </button>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
        </div>
        <!--/.box -->
    </div>
    </div>


@stop



