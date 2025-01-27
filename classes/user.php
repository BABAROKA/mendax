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

    private function checkIfUserExists($username, $email) {
        $user = $this->db->query("SELECT * FROM users WHERE username = :username OR email = :email", [
            ":username" => $username,
            ":email" => $email
        ]);

        if ($user->rowCount() > 0) {
            return false;
        }
        return $user->fetch();
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

    public function login($credentials, $pass) {

        if (filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
            $user = $this->checkIfUserExists("", $credentials);
            if ($user === false) {
                return false;
            }
        }

        $user = $this->checkIfUserExists($credentials, "");
        if($user === false) {
            return false;
        }

        if ($user && password_verify($pass, $user['pass'])) {
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