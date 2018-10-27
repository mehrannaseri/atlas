@foreach($files as $file)
    <div class="col-md-5 col-sm-5">
        <div class=" checkbox rounded-6 medium m-b-2">
            <div class=" checkbox-overlay">
                <input type="checkbox" onchange="useImage(this,{{$file->id}})" id="myCheckbox1" />
                <div class="checkbox-img checkbox-container">
                    <div class="checkbox-checkmark"></div>
                </div>
                <label for="myCheckbox1"><img class="tumb-img" width="250" height="200" src="{{asset($file->file_url)}}"></label>

            </div>
        </div>
    </div>

@endforeach