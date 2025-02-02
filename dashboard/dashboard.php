<?php
    include_once "../classes/auth.php";
    $auth = new Auth();

    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }

    if ($_SESSION['username'] !== "admin") {
        header("Location: ../index.php");
        exit();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="dashboard.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="dashboard.js"></script>
    </head>
    <header>
        <img
            draggable="false"
            class="logo"
            src="../data/images/logo-white.svg"
            alt="Logo"
        >
        <nav class="nav-main">
            <ul class="nav-container">
                <li>
                    <a href="../home/home.php"><img
                            draggable="false"
                            src="../data/images/home-white.svg"
                            alt="Home"
                    ></a>
                </li>
                <li>
                    <a href="../profile/profile.php"><img
                        draggable="false"
                        class="profile"
                        src="../data/images/profile-white.svg"
                        alt="Profile"
                    ></a>
                </li>
            </ul>
        </nav>
    </header>
    <body>
        <div class="dashboard">
            <div class="main-content">
                <div class="user-search">
                    <input type="text" id="searchInput" placeholder="Search for a user"  onkeyup="filterUsers(this)">
                </div>
                <div class="search-results">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Date Of Birth</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="resultsTable">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </body>
</html>
