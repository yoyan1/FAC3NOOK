var image = document.querySelector(".pp");
var input = document.getElementById("img");

input.addEventListener("change", () => {
    image.src = URL.createObjectURL(input.files[0]);
});

var loader = document.querySelector(".preloader");

    window.addEventListener("load", function(){
    loader.style.display = "none";
    
})
    