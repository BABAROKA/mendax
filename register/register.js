let registersubmit = false;

function showError(errorMessage) {
    const errorHandler = document.getElementById("error-message");
    const errorText = document.getElementById("error-text");

    errorText.textContent = errorMessage;
    errorHandler.style.animation = "none";
    errorHandler.offsetHeight;
    errorHandler.style.animation = "showError 5s ease-out forwards";
}

function signup() {
    const email = document.getElementById("email");
    const passwrd = document.getElementById("password");
    const username = document.getElementById("username");
    const birthday = document.getElementById("birthday");
    const details = document.getElementsByClassName("details");
    let errorMessage = "";

    if (username.value.length < 1) {
        details[0].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "First name cant be this short";
            if (username.value.length == 0) {
                username.focus();
                errorMessage = "First name cant be empty";
            }
        }
    }

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

    if (birthday.value == "") {
        details[2].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "Select your birthday";
        }
    }

    if (errorMessage != "") {
        showError(errorMessage);
        return;
    }

    registersubmit = true;

    document.removeEventListener("keydown", (e) => {
        if (e.key == "Enter") {
            signup();
        }
    });
}


function validateForm() {
    signup()
    if (!registersubmit) {
        return false; // Block form submission
    }
    return true; // Allow submission
}

document.addEventListener("keydown", (e) => {
    if (e.key == "Enter") {
        signup();
    }
});
