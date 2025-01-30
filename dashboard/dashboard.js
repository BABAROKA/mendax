document.addEventListener("DOMContentLoaded", function() {
    fetchUsers();
    setInterval(filterUsers(document.getElementById("searchInput")), 5000);
});

function fetchUsers() {
    fetch('fetch_users.php')
        .then(response => response.json())
        .then(data => {
            if (data != null){
                displayUsers(data);
            }
        })
        .catch(error => console.error('Error:', error));
}

function displayUsers(users) {
    console.log(users);
    const resultsTable = document.getElementById("resultsTable");
    resultsTable.innerHTML = "";

    users.forEach(user => {
        const row = `<tr>
            <td>${user.id}</td>
            <td>${user.username}</td>
            <td>${user.email}</td>
            <td>${user.date_of_birth}</td>
            <td>${user.gender}</td>
        </tr>`;
        resultsTable.innerHTML += row;
    });
}

function filterUsers(searchInput) {
    input = searchInput.value.toLowerCase();
    fetch('fetch_users.php')
        .then(response => response.json())
        .then(users => {
            if (users != null){
                const filteredUsers = users.filter(user => 
                    user.username.toLowerCase().includes(input) ||
                    user.email.toLowerCase().includes(input)
                );
                displayUsers(filteredUsers);
            }

        })
        .catch(error => console.error('Error:', error));
}