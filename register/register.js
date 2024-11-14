function login() {
    const email = document.getElementById("email");
    const passwrd = document.getElementById("password");
    const details = document.getElementsByClassName("details")

    if (email.value == "") {
        details[0].style.borderBottom = "2px solid #b00000";
        return;
    }
    if (!email.value.includes("@")) {
        return;
    }
    var splitEmail = email.value.split("@");
    if (splitEmail.length != 2) {
        return;
    }
    if (!splitEmail[1].endsWith(".com") && !splitEmail[1].endsWith(".org") && !splitEmail[1].endsWith(".net")) {
        return;
    }

    if (passwrd.value == "") {
        details[1].style.borderBottom = "2px solid #b00000";
        return;
    }
    if (passwrd.value.length < 8) {
        return;
    }

    if (sessionStorage.getItem("user")) {
        const user = JSON.parse(sessionStorage.getItem("user"));
        if (user.user == splitEmail[0] && passwrd.value) {
            window.location.href = "../index.html";
        }
    }
}