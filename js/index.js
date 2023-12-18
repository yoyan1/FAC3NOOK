
    function signup(){
        var signin = document.querySelector(".signup");
        var signup = document.querySelector(".getStarted");

        signin.style.opacity = 0;
        signin.style.width = "0";
        signup.style.opacity = 1;
        signup.style.width = "100%";
    }

    function signin(){
        var signin = document.querySelector(".signup");
        var signup = document.querySelector(".getStarted");

        signup.style.opacity = 0;
        signup.style.width = "0";
        signin.style.opacity = 1;
        signin.style.width = "100%";

    }

var loader = document.querySelector(".preloader");

    window.addEventListener("load", function(){
    loader.style.display = "none";
    
})
    


       