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

    $filepaths = [];

    foreach ($_FILES['photo']['tmp_name'] as $key => $tmpName) {
        $filename = uniqid() . '_' . basename($_FILES['photo']['name'][$key]);
        $filepath = $uploadDir . $filename;

        if (move_uploaded_file($tmpName, $filepath)) {
            $filepaths[] = $filepath; 
        }
    }

    if (!empty($filepaths)) {
        $filepathsString = implode(',', $filepaths);
        $query = "INSERT INTO photos (user_id, filename, filepath) VALUES (:user_id, :filename, :filepath)";
        $params = [
            ':user_id' => $userId,
            ':filename' => $_FILES['photo']['name'][0], // Use the first file's name
            ':filepath' => $filepathsString
        ];
        $db->query($query, $params);
    }

    header("Location: profile.php");
    exit();
}
?>