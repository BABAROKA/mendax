
function checkClickOutside(event, button, input) {
    if (event.target !== button && event.target !== input) {
        document.removeEventListener('mousedown', (event) => {checkClickOutside(event, button, input)});
        input.style.display = "none";
        button.style.display = "block";
    }
}

function toggleSearch() {
    const button = document.getElementById("toggle-button");
    const input = document.getElementById("toggle-input");
    button.style.display = "none";
    input.style.display = "block";

    document.addEventListener('mousedown', (event) => {
        checkClickOutside(event, button, input);
    });
}

