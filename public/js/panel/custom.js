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

function show_modal(oldAction){
    document.getElementById('modal_form').reset();
    document.getElementById('modal_form').setAttribute('action' , oldAction);
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
    document.getElementById('count_files').style.display = "";
    document.getElementById('count_files').innerText = files.length+' Files selected';
}

function setDir(lang,elems,edit = false) {
    $.ajax({
        type: "GET",
        url: reqUrl+'/setDir',
        dataType: 'text',
        data: {'lang': lang , '_token' : token},
        success: function(res) {
            res = JSON.parse(res);
            var result = "";
            if(!edit){
                $('.select2').val('').trigger("change");
            }
            for(var j = 0 ; j < res[0].categories.length ; j++){
                result += '<option value="'+res[0].categories[j].id+'">'+res[0].categories[j].title+'</option>';
            }
            document.getElementById('category').innerHTML = result;
            result = '';
            for(var k = 0 ; k < res[0].tags.length ; k++){
                result += '<option value="'+res[0].tags[k].id+'">'+res[0].tags[k].title+'</option>';
            }
            document.getElementById('tag').innerHTML = result;
            if(res[0].flag === 'ku' || res[0].flag === 'fa' || res[0].flag === 'ar'){
                for(var i = 0 ; i < elems.length ; i++){
                    document.getElementById(elems[i]).dir = 'rtl';
                }
                var test = document.getElementsByClassName("wysihtml5-sandbox");
                var elmnt = test[0].contentWindow.document.getElementsByClassName("wysihtml5-editor")[0];
                elmnt.dir = 'rtl';
            }
            else{
                for(var i = 0 ; i < elems.length ; i++){
                    document.getElementById(elems[i]).dir = 'ltr';
                }
                var test = document.getElementsByClassName("wysihtml5-sandbox");
                var elmnt = test[0].contentWindow.document.getElementsByClassName("wysihtml5-editor")[0];
                elmnt.dir = 'ltr';
            }
        }
    });
}

var old_files = [];

function useImage(elem,file) {

    if(elem.checked == true){
        old_files.push(file);
    }
    else{
        var index = old_files.indexOf(file);
        old_files.splice(index, 1);
    }

    document.getElementById("counter").innerText = old_files.length;
    document.getElementById("old_count_files").style.display = "";
    document.getElementById("old_count_files").innerText = old_files.length+' Files selected';
    document.getElementById("old_files").value = old_files;
}

function showGallery(files){
    var result = '';
    var files = JSON.parse(files);
    for (var i = 0 ; i < files.length ; i++){

        result += `<div class="col-md-5 col-sm-5">
                        <div class=" checkbox rounded-6 medium m-b-2">
                              <img class="tumb-img" width="250" height="200" src="`+reqUrl+files[i].file_url+`">
                        </div>
                    </div>`;
    }

    document.getElementById('show_img').innerHTML = result;
    open_modal();
}
var permissions = [];
var deletePermissions = [];
var oldPermissions = [];
function permission(elem,id){
    if(elem.checked == true){
        permissions.push(id);
    }
    else{
        var delIndex = oldPermissions.indexOf(id);
        if(delIndex != -1){
            var deleted = oldPermissions[delIndex];
            deletePermissions.push(deleted);
        }
        else{
            var index = permissions.indexOf(id);
            permissions.splice(index, 1);
        }

    }
}

function permissionUser(user) {
    var data = document.getElementById(user).getAttribute("data-content");
    data = JSON.parse(data);
    permissions = [];
    deletePermissions = []
    $(".atlasPermission").prop('checked' , false);
    if(data.length > 0){
        for(var i = 0 ; i < data.length ; i++){

            $("#p"+data[i].id).prop('checked' , true);
            oldPermissions.push(data[i].id);

        }
    }
}

function saveChanges(url){
    var selected_user = document.getElementById("user");
    var message_alert = document.getElementById("message_alert");

    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", url);
    form.setAttribute("target", "_self");

    var user = document.createElement("input");
    user.setAttribute("type", "hidden");
    user.setAttribute("name", "user");
    user.setAttribute("value", selected_user.value);

    var tok = document.createElement("input");
    tok.setAttribute("type", "hidden");
    tok.setAttribute("name", "_token");
    tok.setAttribute("value", token);

    var permission = document.createElement("input");
    permission.setAttribute("type", "hidden");
    permission.setAttribute("name", "permissions");
    permission.setAttribute("value", permissions);

    var deletedPermission = document.createElement("input");
    deletedPermission.setAttribute("type", "hidden");
    deletedPermission.setAttribute("name", "deletedPermission");
    deletedPermission.setAttribute("value", deletePermissions);
    form.appendChild(permission);
    form.appendChild(deletedPermission);
    form.appendChild(user);
    form.appendChild(tok);

    if(selected_user.value == ""){
        message_alert.style.display = "";
        message_alert.innerText = "Please select user to change permission";
    }
    else if(permissions.length == 0 && deletePermissions.length == 0){
        message_alert.style.display = "";
        message_alert.innerText = "There is no change to save";
    }
    else{
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form)
    }

}