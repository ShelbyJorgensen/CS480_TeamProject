document.getElementById("inside").addEventListener("click", showPassword);

document.getElementById("password").addEventListener("onFocus", showPasswordValidation);
document.getElementById("password").addEventListener("onFocus", hidePasswordValidation);
// var letter = document.getElementById("lLetter");
// var capital = document.getElementById("uLetter");
// var number = document.getElementById("number");
// var length = document.getElementById("minChar");

//document.getElementById("accountIcon").addEventListener("click", gotoAccount);

function gotoAccount(){
    location.replace("../Account.html")
}

function showPasswordValidation(){
    document.getElementById("errorMessage").style.display = "block";
}

function hidePasswordValidation(){
    document.getElementById("errorMessage").style.display = "none";
}

function showPassword(){

    let passwordText = document.getElementById("password");
    let icon = document.getElementById("inside");

    if(passwordText.type === "text"){
        passwordText.type = "password";
        icon.className = "bx bx-show";
        
    }else{
        passwordText.type = "text";
        icon.className = "bx bx-hide";
    }
}

// Sidebar Navigation
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("sideBarNav").style.width = "250px";
    // document.getElementById("main").style.marginRight = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,.85)";
  }
  
  /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
  function closeNav() {
    document.getElementById("sideBarNav").style.width = "0";
    // document.getElementById("main").style.marginRight = "0";
    document.body.style.backgroundColor = "rgb(18,18,18)";
  }