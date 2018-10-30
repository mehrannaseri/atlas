@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
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

                    <form method="post" action="{{URL::asset('/panel/dynaform/update')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="form_id" value="{{$form_id}}">
                        <fieldset id="buildyourform">
                            <legend>Build your own form!</legend>

@foreach($elements as $element)
<div class="fieldwrapper  row " id="field1">
    <input type="hidden" name="elementid[]" value="{{$element->id}}">
    <div class="col-xs-3">
        <label>title</label>
        <input class="form-control" name="title[]" type="text" value="{{$element->title}}">
    </div>
    <div class="col-xs-3">
        <label>type of element</label>
        <select class="form-control" name="type[]">
            <option value="text" @if($element->type=="text") selected @endif>Text</option>
            <option value="email" @if($element->type=="email") selected @endif>Email</option>
            <option value="url" @if($element->type=="url") selected @endif>Url</option>
            <option value="tel" @if($element->type=="tel") selected @endif>Telephone</option>
            <option value="number" @if($element->type=="number") selected @endif>Number</option>
            <option value="textarea" @if($element->type=="textarea") selected @endif>TextArea</option>
            <option value="paragraph" @if($element->type=="paragraph") selected @endif>Paragraph</option>
            <option value="checkbox" @if($element->type=="checkbox") selected @endif>Check Box</option>
        </select>
    </div>
    <div class="col-xs-3">
        <label>Css Style</label>
        <textarea class="form-control" name="style[]">{{$element->style}}</textarea>
    </div>
    <div class="col-xs-2">
        <label>Is Required ?</label>
        <input type="checkbox" value="1" name="required[]" @if($element->required==1) checked @endif>
    </div>
    <button type="button" class="remove btn btn-danger " >
        <i class="fa fa-trash"></i></button>
</div><hr>
@endforeach
                        </fieldset>

                        <input type="button" value="Add a field" class="add btn btn-default " id="add" />
                        <button type="submit" class="btn btn-success">add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $("#add").click(function() {

                var lastField = $("#buildyourform div:last");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
                var fieldWrapper = $("<div class=\"fieldwrapper  row \" id=\"field" + intId + "\"/>");
                fieldWrapper.data("idx", intId);
                var fName = $("<div class='col-xs-3'> <label>title</label><input class=\"form-control\" name=\"title[]\" type=\"text\" class=\"fieldname\" /></div>");
                var fType = $("<div class='col-xs-3'> <label>type of element</label> <select class=\"form-control\" name=\"type[]\" class=\"fieldtype\">" +
                    "<option value=\"text\">Text</option>" +
                    "<option value=\"email\">Email</option>" +
                    "<option value=\"url\">Url</option>" +
                    "<option value=\"tel\">Telephone</option>" +
                    "<option value=\"number\">Number</option>" +
                    "<option value=\"textarea\">TextArea</option>" +
                    "<option value=\"paragraph\">Paragraph</option>" +
                    "<option value=\"checkbox\">Check Box</option>" +
                    "</select></div>");
                var removeButton = $("<button type=\"button\" class=\"remove btn btn-danger \" v ><i class=\"fa fa-trash\"></i></button></div>");
                removeButton.click(function() {
                    $(this).parent().remove();
                });
                var style=$("<div class='col-xs-3'><label>Css Style</label> <textarea class='form-control' name=\"style[]\"></textarea></dvi>");
                var required=$("<div class='col-xs-2'> <label>Is Required ?</lable><input type=\"checkbox\" value='1' name=\"required[]\" checked />");
                fieldWrapper.append(fName);
                fieldWrapper.append(fType);
                fieldWrapper.append(style);
                fieldWrapper.append(required);
                fieldWrapper.append(removeButton);
                $("#buildyourform").append(fieldWrapper);
                $("#buildyourform").append("<hr>");
            });
            $(".remove").click(function () {
                $(this).parent().remove();
            })
            /*$("#preview").click(function() {
                $("#yourform").remove();
                var fieldSet = $("<fieldset id=\"yourform\"><legend>Your Form</legend></fieldset>");
                $("#buildyourform div").each(function() {
                    var id = "input" + $(this).attr("id").replace("field","");
                    var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname").first().val() + "</label>");
                    var input;
                    switch ($(this).find("select.fieldtype").first().val()) {
                        case "checkbox":
                            input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id + "\" />");
                            break;
                        case "textbox":
                            input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id + "\" />");
                            break;
                        case "textarea":
                            input = $("<textarea id=\"" + id + "\" name=\"" + id + "\" ></textarea>");
                            break;
                    }
                    fieldSet.append(label);
                    fieldSet.append(input);
                });
                $("body").append(fieldSet);
            });*/
        });
    </script>
@stop
