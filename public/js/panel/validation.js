function check_number(evt,id){ // for use ->onkeypress ="return check_number(event,this.id)"
    evt = (evt) ? evt : window.event;
    var keycode = (evt.which) ? evt.which : evt.keyCode;

    if( (keycode == 8 || keycode == 9 || keycode == 37 || keycode == 39) || ( keycode >= 48 && keycode <= 57)){
        document.getElementById(id).style.borderColor = "";
        return true;
    }
    else{
        document.getElementById(id).style.borderColor = "red";
        return false;
    }
}
//---------------------------------

function check_mobile(){
    //if((\+98|0)?9\d{9}
}

function money_format(element){ //for use : oninput="money_format(this)"
    var string = element.value;
    for(var j = string.length ; j >= 0 ; j--){
        string = string.replace(",", "");
    }
    var pos = 1;
    var output = "";
    for(var i = (string.length-1) ; i >= 0 ; i--){
        output += string.charAt(i);
        if(pos % 3 == 0 && i > 0){
            output += ",";
        }
        pos++;
    }
    output = reverse(output);
    document.getElementById(element.id).value = output;
}

function moneyFormat(string){ //for use : use in interal javascript
    string = string.toString();
    var pos = 1;
    var output = "";
    for(var i = (string.length-1) ; i >= 0 ; i--){
        output += string.charAt(i);
        if(pos % 3 == 0 && i > 0){
            output += ",";
        }
        pos++;
    }
    output = reverse(output);
    return output;
}

function reverse(s) {
    var o = [];
    for (var i = 0, len = s.length; i <= len; i++){
        o.push(s.charAt(len - i));
    }
    return o.join('');
}

///---------------------------------------------
function check_en_char(evt,id){ // for use ->onkeypress ="return check_en_char(event,this.id)"
    evt = (evt) ? evt : window.event;
    var keycode = (evt.which) ? evt.which : evt.keyCode;
    if( (keycode == 8 || keycode == 9 || keycode == 37 || keycode == 39 || keycode == 32 || keycode == 46 || keycode == 58 || keycode == 47) || ( keycode >= 97 && keycode <= 122) || (keycode >= 65 && keycode <= 90)){
        document.getElementById(id).style.borderColor = "";
        return true;
    }
    else{
        document.getElementById(id).style.borderColor = "red";
        return false;
    }
}

function check_fa_char(id){ // for use ->onkeyup ="return check_fa_char(this.id)"
    var chars=["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9"];
    var text = document.getElementById(id).value;
    var text2 = text.substr(-1);
    for (i=0;i<chars.length;i++){
        if (chars[i]==text2){
            document.getElementById(id).value=text.substring(0,text.length-1);
        }
    }
}
///---------------------------------------------
function check_email_char(evt,input){ // for use ->onkeypress ="return check_email_char(event,this)"
    evt = (evt) ? evt : window.event;
    var keycode = (evt.which) ? evt.which : evt.keyCode;
    if( (keycode == 8 || keycode == 9 || keycode == 37 || keycode == 39 || keycode == 46 || keycode == 45 || keycode == 95 || keycode == 64) || ( keycode >= 97 && keycode <= 122) || (keycode >= 65 && keycode <= 90) || ( keycode >= 48 && keycode <= 57)){
        input.style.borderColor = "";
        return true;
    }
    else{
        input.style.borderColor = "red";
        return false;
    }
}



