function login() {
    const email = document.getElementById("email");
    const passwrd = document.getElementById("password");
    const details = document.getElementsByClassName("details")
    const errorHandler = document.getElementById("error-message");
    const errorText = document.getElementById("error-text");

    let errorMessage = "";

    if (email.value == "") {
        details[0].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "email input should not be empty";
        }
    }
    if (!email.value.includes("@")) {
        details[0].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "email is not valid";
        }
    }
    var splitEmail = email.value.split("@");
    if (splitEmail.length != 2) {
        details[0].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "email is not valid";
        }
        
    }

    if (splitEmail.length != 1) {
        if (!splitEmail[1].endsWith(".com") && !splitEmail[1].endsWith(".org") && !splitEmail[1].endsWith(".net")) {
            details[0].style.borderBottom = "2px solid #b00000";
            if (errorMessage == "") {
                errorMessage = "email is not valid";
            }
            
        }
    }

    if (passwrd.value == "") {
        details[1].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "Password cant be empty";
        }
        
    }
    if (passwrd.value.length < 8) {
        details[1].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "Password cant be less than 8 digits";
        }

    }

    if (sessionStorage.getItem("user")) {
        const user = JSON.parse(sessionStorage.getItem("user"));
        if (user.email != email.value) {
            if (errorMessage == "") {
                errorMessage = "Email does not exist";
            }
        }
        if (user.password != passwrd.value) {
            if (errorMessage == "") {
                errorMessage = "Password does not match";
            }
        }
    } 
    else {
        errorMessage = "Sign up first, no account exists";
    }

    if (email.value == "admin" && passwrd.value == "admin") {
        window.location.href = "home/home.html";
        return; 
    }

    if (errorMessage != "") {
        errorText.textContent = errorMessage;
        errorHandler.style.animation = null; 
        errorHandler.offsetHeight;
        errorHandler.style.animation = "showError 5s ease-out forwards";
        return;
    }

    window.location.href = "home/home.html";
}