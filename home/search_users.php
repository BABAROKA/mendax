<?php
    include_once "../classes/database.php";
    include_once "../classes/auth.php";

    $auth = new Auth();
    $db = new Database();
    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    if (isset($data['data'])) {
        $input = $data['data'];
        $result = $db->query("SELECT * FROM users WHERE username LIKE :search LIMIT 10", [
            ":search" => "%" . $input . "%"
        ]);
        if ($result->rowCount() != 0) {
            echo json_encode($result->fetchAll());
            exit();
        }
    }
    echo json_encode(null);
    exit();
?>