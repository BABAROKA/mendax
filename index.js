let submit = false;

function showError(errorMessage) {
    const errorHandler = document.getElementById("error-message");
    const errorText = document.getElementById("error-text");

    errorText.textContent = errorMessage;
    errorHandler.style.animation = "none";
    errorHandler.offsetHeight; // Force reflow
    errorHandler.style.animation = "showError 5s ease-out forwards";
}

function login() {

    const email = document.getElementById("email");
    const passwrd = document.getElementById("password");
    const details = document.getElementsByClassName("details");
    const errorHandler = document.getElementById("error-message");
    const errorText = document.getElementById("error-text");

    let errorMessage = "";

    if (email.value == "") {
        details[0].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            email.focus();
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
        if (
            !splitEmail[1].endsWith(".com") &&
            !splitEmail[1].endsWith(".org") && !splitEmail[1].endsWith(".net")
        ) {
            details[0].style.borderBottom = "2px solid #b00000";
            if (errorMessage == "") {
                errorMessage = "email is not valid";
            }
        }
    }
    if (passwrd.value == "") {
        details[1].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            passwrd.focus();
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
        user = JSON.parse(sessionStorage.getItem("user"));
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

    if (errorMessage != "") {
        showError(errorMessage);
        return;
    }
    submit = true;
    document.removeEventListener("keydown", (e) => {
        if (e.key == "Enter") {
            login();
        }
    });
}

function validateForm() {
    login()
    if (!submit) {
        return false; // Block form submission
    }
    return true; // Allow submission
}

document.addEventListener("keydown", (e) => {
    if (e.key == "Enter") {
        
        login();
    }
});
