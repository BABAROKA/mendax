<?php

    include_once "../classes/auth.php";
    $auth = new Auth();
    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }
        ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="home.js"></script>
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
                    <a href="home.php"><img
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
                    <a href="home.php"><img
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
        <div class="home">
            <div class="messages" id="messages">
                <ul>
                    <li>
                        <div class="user-info">
                            <img
                                draggable="false"
                                src="../data/images/users/cat.jpg"
                                alt="User 1"
                                class="rounded-image"
                            >
                            <div class="info">
                                <p class="username">Filan Fisteku</p>
                                <p class="last-text">Hello, how are you?</p>
                            </div>
                        </div>
                        <div class="list-separator"></div>
                    </li>

                    <li>
                        <div class="user-info">
                            <img
                                draggable="false"
                                src="../data/images/users/portrait-woman.jpg"
                                alt="User 2"
                                class="rounded-image"
                            >
                            <div class="info">
                                <p class="username">Jane Smith</p>
                                <p class="last-text">What's up?</p>
                            </div>
                        </div>
                        <div class="list-separator"></div>
                    </li>
                    <li>
                        <div class="user-info">
                            <img
                                draggable="false"
                                src="../data/images/users/portrait-man.jpg"
                                alt="User 3"
                                class="rounded-image"
                            >
                            <div class="info">
                                <p class="username">Bob Johnson</p>
                                <p class="last-text">Hi, how's it going?</p>
                            </div>
                        </div>
                        <div class="list-separator"></div>
                    </li>
                </ul>
            </div>
            <div class="feed">
                <div class="post">
                    <div class="post-header">
                        <div class="post-user">
                            <img
                                draggable="false"
                                src="../data/images/users/portrait-man.jpg"
                                alt="User 1"
                            >
                            <p class="username">Bob Johnson</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <!-- <div class="above-image"></div> -->
                        <img
                            draggable="false"
                            src="../data/images/posts/architecture.jpg"
                            class="post-image"
                            alt="Post"
                            id="1"
                        >
                    </div>
                    <div class="actions">
                        <button onclick="like(this)" class="like" id="1">
                            <svg width="24" height="24" viewBox="0 0 512 512">
                                <path
                                    id="likepath"
                                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="post">
                    <div class="post-header">
                        <div class="post-user">
                            <img
                                draggable="false"
                                src="../data/images/users/portrait-woman.jpg"
                                alt="User 2"
                            >
                            <p class="username">Jane Smith</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <!-- <div class="above-image"></div> -->
                        <img
                            draggable="false"
                            src="../data/images/posts/nature (2).jpg"
                            class="post-image"
                            alt="Post"
                            id="2"
                        >
                    </div>
                    <div class="actions">
                        <button onclick="like(this)" class="like" id="2">
                            <svg width="24" height="24" viewBox="0 0 512 512">
                                <path
                                    id="likepath"
                                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="post">
                    <div class="post-header">
                        <div class="post-user">
                            <img
                                draggable="false"
                                src="../data/images/users/cat.jpg"
                                alt="User 3"
                            >
                            <p class="username">Filan Fisteku</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <!-- <div class="above-image"></div> -->
                        <img
                            draggable="false"
                            src="../data/images/posts/nature.jpg"
                            class="post-image"
                            alt="Post"
                            id="3"
                        >
                    </div>
                    <div class="actions">
                        <button onclick="like(this)" class="like" id="3">
                            <svg width="24" height="24" viewBox="0 0 512 512">
                                <path
                                    id="likepath"
                                    d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
