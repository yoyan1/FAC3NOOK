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
        setTimeout(function () {
            menu.style.opacity = 1;
            up.style.display = "block";
            down.style.display = "none";
        }, 10)
    } else{
        setTimeout(function () {
            menu.style.opacity = 0;
            down.style.display = "block";
            up.style.display = "none";
        }, 1000)
    }
}

var root = document.querySelector(':root');

function change(){
    $.ajax({
        url:'../php/theme.php',
        method:'POST',
        
    })
}

var loader = document.querySelector(".preloader");
var popErr = document.querySelector(".err");
var popSucc = document.querySelector(".suc");

setTimeout(() => {
    popErr.style.display = "none";
}, 3000);

setTimeout(() => {
    popSucc.style.display = "none";
}, 3000);

    window.addEventListener("load", function(){
    loader.style.display = "none";
})

var message = document.querySelector(".message");



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
        

var notif = document.querySelector(".notif-dropdown");

