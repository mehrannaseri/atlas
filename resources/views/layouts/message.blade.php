@if(!empty($errors->first()))
    <div id="message_alert" class="alert alert-danger" role="alert">
        <span>{{ $errors->first() }}</span>
    </div>
@endif
@if (Session::has('success'))
    <div id="message_alert" class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('delete'))
    <div id="message_alert" class="alert alert-warning">{{ Session::get('delete') }}</div>
@endif