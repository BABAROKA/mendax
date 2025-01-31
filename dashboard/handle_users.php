<?php
    try {
        include_once "../classes/database.php";
        include_once "../classes/auth.php";

        $db = new Database();
        $auth = new Auth();

        if ($_SESSION['username'] !== "admin") {
            echo json_encode(null);
            exit();
        }

        if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
            $userId = intval($_GET["delete"]);
            $db->query("DELETE FROM photos WHERE user_id = :id", ["id" => $userId]);
            $db->query("DELETE FROM users WHERE id = :id", ["id" => $userId]);
            exit();
        }

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