<?php

require_once '../classes/auth.php';
require_once '../classes/database.php';

$auth = new Auth();
$db = new Database();

if (!$auth->isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $userId = $_SESSION['user_id']; // Get the logged-in user's ID
    $uploadDir = '../data/uploads/'; // Directory to store uploaded photos

    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate a unique filename
    $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
    $filepath = $uploadDir . $filename;

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
        // Save the photo information in the database
        $query = "INSERT INTO photos (user_id, filename, filepath) VALUES (:user_id, :filename, :filepath)";
        $params = [
            ':user_id' => $userId,
            ':filename' => $filename,
            ':filepath' => $filepath
        ];
        $db->query($query, $params);

        header("Location: home.php"); // Redirect back to the home page
        exit();
    } else {
        echo "Failed to upload photo.";
    }
}
?>