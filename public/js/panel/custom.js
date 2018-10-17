function editLanguage(id,language,flag){
    document.getElementById('language').value = language;
    document.getElementById('flag').value = flag;
    document.getElementById("modal_form").setAttribute('action' , reqUrl+'/language/edit/'+id);
    open_modal();
}

function open_modal() {
    $('#modal').modal({
        show: 'true'
    });
}

function show_modal(){
    document.getElementById('modal_form').reset();
}

function parentByLang(lang,cat) {

    $.ajax({
        type:'POST',
        url:reqUrl+'/category/getByLang',
        dataType: 'JSON',
        data: { '_token' : token , 'lang' : lang },
        success:function(data) {
            if(cat == '') {
                var result = '<option selected hidden disabled="" value="">Select parent</option>';
            }
            else{
                var result = '<option selected value="">No parent</option>';
            }
            for(var i = 0 ; i < data.length ; i++){
                if(cat.id != data[i].id){
                    result += '<option ' + (cat.parent_id != '' && cat.parent_id == data[i].id ? 'selected' : '') + ' value="' + data[i].id + '">' + data[i].title + '</option>';
                }
            }
            document.getElementById('parent').innerHTML = result;
        }
    });
}

function editCategory(cat) {
    parentByLang(cat.lang_id,cat);
    show_modal();
    document.getElementById("title").value = cat.title;
    document.getElementById("language").value = cat.lang_id;

    document.getElementById('modal_form').setAttribute('action' , reqUrl+'/category/update/'+cat.id);
    open_modal();

}

function remove(url) {

    alertify.confirm(" By deleting this item its posts will also be deleted, do you want to continue?",
        function(){
            window.location.assign(url);
        },
        function(){
        }
    );
}

function editTag(tag) {
    document.getElementById("title").value = tag.title;
    document.getElementById("language").value = tag.lang_id;
    document.getElementById("modal_form").setAttribute('action',reqUrl+'/tag/update/'+tag.id);

    open_modal();
}

function CountSelected() {
    var files = document.getElementById("file_select").files;
    alert(files.length);
}