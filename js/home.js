// const heart = document.getElementById("react");

// heart.onclick = function() {
    
//     heart.classList.remove("fa-regular fa-heart"); 
//     heart.classList.add("fa-solid fa-heart");
// }


function dropdown(){
    var menu = document.querySelector(".dropdown");
    var up = document.getElementById("up");
    var down = document.getElementById("down");
    var opacity = menu.style.opacity;

    if (opacity == 0){
        menu.style.opacity = 1;
        up.style.display = "block";
        down.style.display = "none";
    } else{
        menu.style.opacity = 0;
        down.style.display = "block";
        up.style.display = "none";
    }
}

var root = document.querySelector(':root');

function darkMode(){

    root.style.setProperty('--background-color', '#1b1b1b');
    root.style.setProperty('--font-color', '#d8d0d0');
    root.style.setProperty('--style-color', 'black');
    root.style.setProperty('--input--color', '#2e2d2d');
    root.style.setProperty('--post-color', '#2e2e2e');
    document.querySelector('.reaction_list').style.background = "#1b1b1b";
    document.getElementById('on').style.display ="block";
    document.getElementById('off').style.display ="none";
}

function lightMode(){

    root.style.setProperty('--background-color', '#d4d8dbc9');
    root.style.setProperty('--font-color', '#000000');
    root.style.setProperty('--style-color', 'white');
    root.style.setProperty('--input--color', '#ece7e7');
    root.style.setProperty('--post-color', 'white');
    document.querySelector('.reaction_list').style.background = "white";
    document.getElementById('off').style.display ="block";
    document.getElementById('on').style.display ="none";
}

var loader = document.querySelector(".preloader");

    window.addEventListener("load", function(){
    loader.style.display = "none";
    
})

var message = document.querySelector(".message");

function showAll() {
   
    var msgDisplay = message.style.display;

    if(msgDisplay == "none"){
        message.style.display = "block";

    } else{
        message.style.display = "none";
    }

}

        let offsetX, offsetY;
        let isDragging = false;

        message.addEventListener('mousedown', (e) => {
            isDragging = true;
            offsetX = e.clientX - message.getBoundingClientRect().left;
            offsetY = e.clientY - message.getBoundingClientRect().top;
        });

        document.addEventListener('mousemove', (e) => {
        if (isDragging) {
            message.style.left = e.clientX - offsetX + 'px';
            message.style.top = e.clientY - offsetY + 'px';
        }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });
        

       