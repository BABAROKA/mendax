<?php
require_once "database.php";
require_once "auth.php";

class User {
    private $db;
    private $auth;

    public function __construct() {
        $this->db = new Database();
        $this->auth = new Auth();
    }

    private function checkIfUserExists($email) {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            ":email" => $email
        ]);

        if ($user->rowCount() > 0) {
            return $user->fetch();
        }
        return false;
    }

    public function register($username, $email, $pass, $dateOfBirth, $gender) {
        $user = $this->checkIfUserExists($username, $email);
        if ($user !== false) {
            return false;
        }
    
        $result = $this->db->query(
            "INSERT INTO users (username, email, pass, date_of_birth, gender) 
            VALUES (:username, :email, :pass, :date_of_birth, :gender)",
            [
                ":username" => $username,
                ":email" => $email,
                ":pass" => password_hash($pass, PASSWORD_DEFAULT),
                ":date_of_birth" => $dateOfBirth,
                ":gender" => $gender
            ]
        );
    
        return $result !== false; // Return true on success
    }

    public function login($email, $pass) {

        $user = $this->checkIfUserExists($email);
        if($user == false) {
            return false;
        }

        if (password_verify($pass, $user['pass'])) {
            $this->auth->login($user['id'], $user['username']);
            return true;
        }
        return false;
    }

    public function logout() {
        if(!$this->isLoggedIn()) {
            return;
        }
        $this->auth->logout();
    }

    public function isLoggedIn(): bool {
        return $this->auth->isLoggedIn();
    }
}

?>