var userin = document.getElementById("addNew");

function addNew(){
    userin.style.height = "auto";
    userin.style.opacity = 1;
    
}

function close(){
    userin.style.opacity = 0;
    userin.style.height = "0";
}

var confirm = document.querySelector('.confirm');

var toDelete = document.querySelector('.delete');

toDelete.addEventListener('click', show);

function show(){
    var opacity = confirm.style.opacity;

    if(opacity == 0){
        confirm.style.opacity = 1;
        confirm.style.pointerEvents = "auto";
        confirmation();
    } else{
        confirm.style.opacity = 0;
        confirm.style.pointerEvents = "none";
    }
}

var yes = document.querySelector('.yes');

yes.addEventListener('click', confirmation);

function confirmation(){
    if (yes == 1){
        return true;
    } else{
        show();
    }
}