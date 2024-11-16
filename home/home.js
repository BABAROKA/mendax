function checkClickOutside(event, button, input) {
    if (event.target != input) {
        document.removeEventListener('mousedown', event => {checkClickOutside(event, button, input)});
        
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

    document.addEventListener('mousedown', event => {
        checkClickOutside(event, button, input);
    });
}
let isLike = {};
function like(like) {
    if (isLike[like.id]) {
        like.children[0].children[0].style.animation = "dislike 0.2s ease-out forwards";
        isLike[like.id] = false;
        return
    }
    
    like.children[0].children[0].style.animation = "like 0.2s ease-out forwards";
    isLike[like.id] = true;
}