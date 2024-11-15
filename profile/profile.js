const getProfile = () => {
    if (sessionStorage.getItem("user")) {
    let profileName = document.getElementById("profile-name");
        let user = JSON.parse(sessionStorage.getItem("user"));
        profileName.textContent = user.firstName + " " + user.lastName;
        console.log(profileName);
    }
}

window.onload = getProfile;