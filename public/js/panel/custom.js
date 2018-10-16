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