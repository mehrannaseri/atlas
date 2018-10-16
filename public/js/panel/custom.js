function editLanguage(id,language,flag){
    document.getElementById('language').value = language;
    document.getElementById('flag').value = flag;
    document.getElementById("modal_form").setAttribute('action' , 'panel/language/edit/'+id);
    $('#modal-language').modal({
        show: 'true'
    });
}

function show_modal(){
    document.getElementById('language').value = "";
    document.getElementById('flag').value = "";
}

function parentByLang(lang) {

    $.ajax({
        type:'POST',
        url:reqUrl+'/category/getByLang',
        dataType: 'JSON',
        data: { '_token' : token , 'lang' : lang },
        success:function(data) {
            var result = '<option selected hidden disabled="" value="">Select parent</option>';
            for(var i = 0 ; i < data.length ; i++){
                result += '<option value="'+data[i].id+'">'+data[i].title+'</option>';
            }
            document.getElementById('parent').innerHTML = result;
        }
    });
}