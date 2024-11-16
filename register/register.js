function signup() {
    const email = document.getElementById("email");
    const passwrd = document.getElementById("password");
    const firstName = document.getElementById("FirstName");
    const lastName = document.getElementById("LastName");
    const birthday = document.getElementById("birthday");
    const gender = document.getElementById("gender");
    const details = document.getElementsByClassName("details")
    const errorHandler = document.getElementById("error-message");
    const errorText = document.getElementById("error-text");

    let errorMessage = "";

    if (firstName.value.length < 1) {
        details[0].children[0].children[0].style.borderBottom = "2px solid #b00000";
        if (errorMessage == "") {
            errorMessage = "First name cant be this short";
            if (firstName.value.length == 0) {
                firstName.focus();
                errorMessage = "First name cant be empty";
            }
        }
        
    }

    if (lastName.value.length < 1) {
        details[0].children[0].children[1].style.borderBottom = "2px solid #b00000";

        if (errorMessage == "") {
            errorMessage = "Last name cant be this short";
            if (lastName.value.length == 0) {
                lastName.focus();
                errorMessage = "Last name cant be empty";
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
        errorText.textContent = errorMessage;
        errorHandler.style.animation = null; 
        errorHandler.offsetHeight;
        errorHandler.style.animation = "showError 5s ease-out forwards";
        return;
    }

    sessionStorage.setItem("user", JSON.stringify({
        email: email.value,
        password: passwrd.value,
        firstName: firstName.value,
        lastName: lastName.value,
        birthday: birthday.value,
        gender: gender.value
    }));

    document.removeEventListener('keydown', e => {
        if (e.key == "Enter") {
            signup();
        }
    })
    window.location.href = "../index.html";
}


document.addEventListener('keydown', e => {
    if (e.key == "Enter") {
        signup();
    }
})