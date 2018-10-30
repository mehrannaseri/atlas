@extends('adminlte::page')

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
@foreach($form->elements as $element)
    @foreach($values as $value)
        @if($value->element_id==$element->id && in_array($element->id,$el_id))
            @if(in_array($element->type,['text','email','url','number','tel','file']))
                <p><label for="">{{$element->title}}</label> <input style="{{$element->style}}" type="{{$element->type}}" name="{{$element->id}}" class="form-control" value="{{$value->value}}" ></p>
            @elseif($element->type=='checkbox')
                <div class="checkbox">
                <label>
                <input @if($value->value==1) checked @endif type="checkbox" style="{{$element->style}}" name="{{$element->id}}"> {{$element->title}}
                </label>
                </div>
            @else
                <p class="text-justify">{{$element->title}}</p>
            @endif
        @endif
    @endforeach
@endforeach
                </div>
            </div>
        </div>
    </div>
    @stop