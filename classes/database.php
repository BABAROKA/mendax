<?php
    class Database {
        private $pdo;

        public function __construct() {
            $host = 'localhost';
            $db = 'mendax';
            $user = 'root';
            $pass = '';

            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                $this->pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                throw $e;  // Re-throw original exception
            }
        }

        public function getPDO() {
            return $this->pdo;
        }

        public function query($sql, $params = []) {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
    }
?>