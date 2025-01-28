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
    $userId = $_SESSION['user_id']; 
    $uploadDir = '../data/uploads/'; 

  
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

   
    $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
    $filepath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
   
        $query = "INSERT INTO photos (user_id, filename, filepath) VALUES (:user_id, :filename, :filepath)";
        $params = [
            ':user_id' => $userId,
            ':filename' => $filename,
            ':filepath' => $filepath
        ];
        $db->query($query, $params);

        header("Location: profile.php"); 
        exit();
    } else {
        echo "Failed to upload photo.";
    }
}
?>