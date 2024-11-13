
function checkClickOutside(event, button, input) {
    if (event.target !== button && event.target !== input) {
        document.removeEventListener('mousedown', event => {checkClickOutside(event, button, input)});

        input.style.animation = "shrink 0.2s linear forwards";
        button.style.display = "block";
    }
}

function toggleSearch() {
    const button = document.getElementById("toggle-button");
    const input = document.getElementById("toggle-input");

    button.style.display = "none";
    input.style.display = "block";
    input.style.animation = "grow 0.2s linear";

    document.addEventListener('mousedown', event => {
        checkClickOutside(event, button, input);
    });
}

let isLike;
function like(like) {
    if (isLike) {
        like.children[0].children[0].style.animation = "dislike 0.2s ease-out forwards";
        isLike = false;
        return
    }
    
    like.children[0].children[0].style.animation = "like 0.2s ease-out forwards";
    isLike = true;
}