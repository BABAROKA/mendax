function checkClickOutside(event, button, input) {
    if (event.target != input) {
        document.removeEventListener("mousedown", (event) => {
            checkClickOutside(event, button, input);
        });

        input.style.display = "none";
        button.style.display = "block";
    }
}

function toggleSearch() {
    let button = document.getElementById("toggle-button");
    let input = document.getElementById("toggle-input");

    input.style.display = "block";
    button.style.display = "none";
    input.style.animation = "grow 0.2s linear";

    document.addEventListener("mousedown", (event) => {
        checkClickOutside(event, button, input);
    });
}
let isLike = {};
function like(like) {
    if (isLike[like.id]) {
        like.children[0].children[0].style.animation =
            "dislike 0.2s ease-out forwards";
        isLike[like.id] = false;
        return;
    }

    like.children[0].children[0].style.animation =
        "like 0.2s ease-out forwards";
    isLike[like.id] = true;
}

function showMessages() {
    const messages = document.getElementById("messages");
    if (messages.style.left == "0px") {
        messages.style.left = "-260px";
        return;
    }
    messages.style.left = "0px";
}

document.addEventListener("click", (event) => {
    if (event.target.classList.contains("post-image")) {
        if (event.detail === 2) {
            let likes = document.getElementsByClassName("like");
            like(likes[parseInt(event.target.id) - 1]);
        }
    }
});
