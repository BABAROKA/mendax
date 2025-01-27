<?php
    class Auth {
        public function __construct() {
            $this->startSession();
        }

        private function startSession() {
            session_set_cookie_params([
                'secure' => isset($_SERVER['HTTPS']),
                'samesite' => 'Lax'
            ]);
            session_start();
        }

        public function login($userId, $username) {
            session_regenerate_id(true);
        
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
        }

        public function isLoggedIn() {
            return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
        }

        public function logout() {
            session_destroy();
            session_regenerate_id(true);
            session_abort();
            session_unset();
            session_write_close();
        }

    }

?>