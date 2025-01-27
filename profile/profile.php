<?php

    include_once "../classes/auth.php";
    $auth = new Auth();
    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="profile.css">
        <script src="profile.js"></script>
    </head>
    <header>
        <img
            draggable="false"
            class="logo"
            src="../data/images/logo-white.svg"
            alt="Logo"
        >
        <button class="messaging" onclick="showMessages()">
            <img
                draggable="false"
                src="../data/images/messages-white.svg"
                alt="Messages"
            >
        </button>
        <nav class="nav-main">
            <ul class="nav-container">
                <li>
                    <a href="../home/home.php"><img
                            draggable="false"
                            src="../data/images/home-white.svg"
                            alt="Home"
                        ></a>
                </li>
                <li class="search">
                    <button id="toggle-button" onclick="toggleSearch()">
                        <img
                            draggable="false"
                            src="../data/images/search-white.svg"
                            alt="Search"
                        >
                    </button>
                    <input id="toggle-input" type="text" placeholder="Search">
                </li>
                <li>
                    <a href="../home/home.php"><img
                            draggable="false"
                            src="../data/images/bell-white.svg"
                            alt="Notification"
                        ></a>
                </li>
            </ul>
        </nav>
        <div>
        <a href="../profile/profile.php"><img
                draggable="false"
                class="profile"
                src="../data/images/plus.svg"
                alt="Plus"></a>

        <a href="../profile/profile.php"><img
                draggable="false"
                class="profile"
                src="../data/images/profile-white.svg"
                alt="Profile"
            ></a>

            </div>
    </header>

    <body>
        <div class="profile-container">
            <div class="profile-card">
                <img
                    src="../data/images/users/cat.jpg?height=200&width=600"
                    alt="Cover"
                    class="cover-image"
                >
                <div class="profile-content">
                    <img
                        src="../data/images/profile-white.svg"
                        alt="Profile"
                        class="profile-picture"
                    >
                    <div class="profile-info">
                        <h1 class="profile-name" id="profile-name">
                            <?php 
                            echo htmlspecialchars($username);   
                            ?></h1>
                        <!-- <p class="profile-username">@janedoe</p> -->
                    </div>
                    <div class="profile-actions">
                        <button class="btn followbutton">
                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"
                                >
                                </path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            Follow
                        </button>
                        <button class="btn messagebutton">
                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"
                                >
                                </path>
                            </svg>
                            Message
                        </button>
                    </div>
                    <p class="profile-bio">
                        Passionate photographer 📸 | Travel enthusiast ✈️ |
                        Coffee lover ☕ | Sharing my adventures and capturing
                        life's beautiful moments one click at a time.
                    </p>
                    <div class="profile-stats">
                        <span><span class="stat-value">1,234</span> Posts</span>
                        <span><span class="stat-value">5,678</span>
                            Followers</span>
                        <span><span class="stat-value">901</span>
                            Following</span>
                    </div>
                    <div class="profile-tabs">
                        <div class="tab active">Posts</div>
                        <div class="tab">Photos</div>
                        <div class="tab">Videos</div>
                    </div>
                </div>
            </div>
            <div class="content-grid">
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
            </div>
        </div>
    </body>
</html>
