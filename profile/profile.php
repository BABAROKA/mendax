<?php

    include_once "../classes/auth.php";
    include_once "../classes/database.php";
    $db = new Database();
    $auth = new Auth();
    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }

    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $userId = intval($_GET["id"]);
        $username = $db->query("SELECT username FROM users WHERE id = :id", ["id" => $userId])->fetchAll()[0]["username"];
    }

    $query = "SELECT * FROM photos WHERE user_id = :user_id ORDER BY uploaded_at DESC";
    $params = [':user_id' => $userId];
    $photos = $db->query($query, $params)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="profile.css">
        <script src="profile.js"></script>

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
                    <a href="#" onclick="openUploadModal()">
                        <img
                        draggable="false"
                        src="../data/images/plus.svg"
                        alt="Plus"></a>
                </li>
                <li>
                    <a href="../home/home.php"><img
                        draggable="false"
                        src="../data/images/home-white.svg"
                        alt="Home"
                        ></a>
                </li>
                <li>
                    <a href="handler.php">
                        <img
                        draggable="false"
                        src="../data/images/logout.svg"
                        alt="Plus"></a>
                    
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
                </li>
                <li>
                    <a href="../home/home.php"><img
                            draggable="false"
                            src="../data/images/bell-white.svg"
                            alt="Notification"
                        ></a>
                </li> -->
            </ul>
        </nav>
    </header>

    <body>
        <?php if ( $_SESSION['username'] === "admin"): ?>
            <a href="../dashboard/dashboard.php"><button class="dash-button"><img src="../data/images/dash.svg" alt="Dashbord"></button></a>
        <?php endif; ?>
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
                    </div>
                </div>
            </div>
            <div class="content-grid">
    <?php foreach ($photos as $photo): ?>
        <?php
        // Split the file paths into an array
        $images = explode(',', $photo['filepath']);
        foreach ($images as $image): ?>
            <div class="content-item"> 
                <img src="<?= htmlspecialchars(trim($image)) ?>" alt="Post">
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
              <!--  <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>
                <div class="content-item"></div>-->
            </div>
        </div>

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
