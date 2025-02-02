function showInput() {
    const overlay = document.getElementById('overlay');
    const input = document.getElementById('inputField');

    overlay.style.display = 'flex';
    input.value = "";

    overlay.removeEventListener('click', function (event) {
        if (!inputContainer.contains(event.target)) {
            overlay.style.display = 'none';
        }
    });
}

function getUsers(searchInput) {
    input = searchInput.value;
    const resultsContainer = document.getElementById('resultsContainer');
    resultsContainer.innerHTML = "";
    fetch('search_users.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ data: input}),
    })
    .then(response => response.json())
    .then(users => {
        if (users != null) {
            users.forEach(user => {
                resultsContainer.innerHTML += `<div class="user-result"><a href="/profile/profile.php?id=${user.id}">${user.username}</a></div>`
            });
        }


    })
    .catch(error => console.error(error));
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

document.addEventListener('DOMContentLoaded',() => {
    const overlay = document.getElementById('overlay');

    overlay.addEventListener('click', function (event) {
        if (!inputContainer.contains(event.target)) {
            overlay.style.display = 'none';
        }
    });
});

// document.addEventListener("click", (event) => {
//     if (event.target.classList.contains("post-image")) {
//         if (event.detail === 2) {
//             let likes = document.getElementsByClassName("like");
//             like(likes[parseInt(event.target.id) - 1]);
//         }
//     }
// });
