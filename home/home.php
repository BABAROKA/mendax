<?php

    include_once "../classes/auth.php";
    $auth = new Auth();
    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }

    include_once "../classes/database.php";
    $db = new Database();
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM photos ORDER BY RAND() LIMIT 10";
    $photos = $db->query($query)->fetchAll();
        ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="home.js"></script>

       
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
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
                    <a href="#" onclick="openUploadModal()"><img
                    draggable="false"
                    src="../data/images/plus.svg"
                    alt="Plus"></a>
                </li>
                <li>
                    <button class="search-button" onclick="showInput()"><img
                        draggable="false"
                        src="../data/images/search-white.svg"
                        alt="Search"
                    ></button>
                </li>
                <li>
                    <a href="home.php"><img
                            draggable="false"
                            src="../data/images/home-white.svg"
                            alt="Home"
                        ></a>
                </li>
                <li>
                    <a href="../profile/profile.php"><img
                        draggable="false"
                        src="../data/images/profile-white.svg"
                        alt="Profile"
                    ></a>
                </li>

                <!-- <li class="search">
                    <button id="toggle-button" onclick="toggleSearch()">
                        <img
                            draggable="false"
                            src="../data/images/search-white.svg"
                            alt="Search"
                        >
                    </button>
                    <input id="toggle-input" type="text" placeholder="Search">
                </li> -->
                <!-- <li>
                    <a href="home.php"><img
                            draggable="false"
                            src="../data/images/bell-white.svg"
                            alt="Notification"
                        ></a>
                </li>             -->
            </ul>
        </nav>


    </header>
    <body id="body">
        
        <div id="overlay" class="overlay">
            <div id="inputContainer" class="input-container">
                <input type="text" id="inputField" placeholder="Search User..." onkeyup="getUsers(this)">
                <div id="resultsContainer"></div>
            </div>
        </div>
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
    <?php foreach ($photos as $photo): ?>
        <div class="post">
            <div class="post-header">
                <div class="post-user">
                    <img draggable="false" src="../data/images/profile-white.svg" alt="Profile">
                    <p class="username"><?= htmlspecialchars($photo['username']) ?></p>
                </div>
            </div>
            <div class="post-content slider">
                <?php
                $images = explode(',', $photo['filepath']);
                foreach ($images as $image): ?>
                    <img draggable="false" src="<?= htmlspecialchars(trim($image)) ?>" class="post-image" alt="Post">
                <?php endforeach; ?>
            </div>
            <div class="actions">
                <button onclick="like(this)" class="like">
                    <svg width="24" height="24" viewBox="0 0 512 512">
                        <path id="likepath" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

               <!-- <div class="post">
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
                         <div class="above-image"></div> 
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
                         <div class="above-image"></div> 
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
        </div> -->

    
        <div id="uploadModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUploadModal()">&times;</span>
        <h2 class="modal-title">Upload Photo</h2>
        <form id="uploadForm" action="upload_photo.php" method="POST" enctype="multipart/form-data">
            <div class="file-input-container">
                <label for="photo" class="file-label">
                    <span class="file-button">Choose File</span>
                    <span class="file-name" id="fileName">No file chosen</span>
                </label>
           
                <input type="file" name="photo[]" id="photo" accept="image/*" multiple required onchange="previewImage(event)">
            </div>
           
            <div id="imagePreviewContainer" class="image-preview-container">
              
            </div>
            <button type="submit" class="submit-button">Upload</button>
        </form>
    </div>
</div>
<script>
function openUploadModal() {
    document.getElementById("uploadModal").style.display = "block";
}

function closeUploadModal() {
    document.getElementById("uploadModal").style.display = "none";
    
    document.getElementById("uploadForm").reset();
    document.getElementById("imagePreviewContainer").style.display = "none";
    document.getElementById("fileName").textContent = "No file chosen";
}

function previewImage(event) {
    const fileInput = event.target;
    const fileNameDisplay = document.getElementById("fileName");
    const imagePreviewContainer = document.getElementById("imagePreviewContainer");

    imagePreviewContainer.innerHTML = ""; // Clear previous previews

    if (fileInput.files.length > 0) {
        fileNameDisplay.textContent = fileInput.files.length + " files chosen";

        for (let i = 0; i < fileInput.files.length; i++) {
            const file = fileInput.files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("image-preview");
                imagePreviewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
        imagePreviewContainer.style.display = "block";
    } else {
        fileNameDisplay.textContent = "No file chosen";
        imagePreviewContainer.style.display = "none";
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.slider').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 400,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    });
</script>
    </body>
</html>
