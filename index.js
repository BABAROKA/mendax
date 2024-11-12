
function checkClickOutside(event, button, input) {
    if (event.target !== button && event.target !== input) {
        document.removeEventListener('mousedown', event => {checkClickOutside(event, button, input)});

        input.classList.remove('show');
        button.style.display = "block";
    }
}

function toggleSearch() {
    const button = document.getElementById("toggle-button");
    const input = document.getElementById("toggle-input");
    button.style.display = "none";
    input.classList.add('show');

    document.addEventListener('mousedown', event => {
        checkClickOutside(event, button, input);
    });
}

function like(like) {
    if (like.children[0].children[0].classList.contains("liked")) {
        like.children[0].children[0].classList.remove("liked");
        return
    }
    like.children[0].children[0].classList.add("liked");
}