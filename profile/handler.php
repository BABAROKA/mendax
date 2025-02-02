<?php
    include_once "../classes/auth.php";
    $auth = new Auth();
    if (!$auth->isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }

    $auth->logout();
    header("Location: ../index.php");
    exit();
?>