var fname = document.forms['Form']['uname'];
var uname = document.forms['Form']['uname'];
var pass = document.forms['Form']['psw'];
var error = document.getElementById('error');
var error_pass = document.getElementById('error_pass');

uname.addEventListener('textInput', email_Verify, validated);
pass.addEventListener('textInput', pass_Verify, validated);
fname.addEventListener('textInput', pass_Verify, validated);

function validated() {
    if (uname.value.length == 0) {
        uname.style.border = "1px solid red";
        error.innerHTML ="username is required";
        uname.focus();
        return false;
    }
    
    if (pass.value.length == 0) {
        pass.style.border = "1px solid red";
        error_pass.innerHTML ="password is required";
        pass.focus();
        return false;
    }
}
function email_Verify(){
    if (uname.value.length >= 5) {
        uname.style.border = "1px solid silver";
        error.style.display = 'none';
        return true;
    }
    
}

function pass_Verify(){
     if (pass.value.length >= 5) {
        pass.style.border = "1px solid silver";
        error_pass.style.display = 'none';
        return true;
    }
}

       