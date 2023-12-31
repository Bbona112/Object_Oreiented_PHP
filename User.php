<?php
require_once 'Database.php';

class User {
    private $db;


    public function __construct() {
        $this->db = new Database();
    }

    public function register($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO user_data (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT id, username, password FROM user_data WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUsers() {
        $conn = $this->db->connect();
        $stmt = $conn->query("SELECT id, username FROM user_data");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>