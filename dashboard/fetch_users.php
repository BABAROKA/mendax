<?php
    try {
        include_once "../classes/database.php";

        $db = new Database();
        $query = "SELECT id, username, email, date_of_birth, gender FROM users ORDER BY id DESC LIMIT 10";
        $result = $db->query($query);
        if ($result->rowCount() != 0) {
            echo json_encode($result->fetchAll());
            exit();
        }

        echo json_encode(null);

    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
    exit();
?>