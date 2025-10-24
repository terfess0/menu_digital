<?php
class UserController {
    private $userModel;

    public function __construct() {
        require_once '../models/User.php';
        $this->userModel = new User();
    }

    public function register($name, $email, $phone, $address, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->insertUser($name, $email, $phone, $address, $hashedPassword);
    }

    public function login($email, $password) {
        $user = $this->userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'Client'; // Assuming role is set to 'Client' for registered users
            return true;
        }
        return false;
    }

    public function viewProfile($userId) {
        return $this->userModel->getUserById($userId);
    }

    public function updateProfile($userId, $name, $email, $phone, $address) {
        return $this->userModel->updateUser($userId, $name, $email, $phone, $address);
    }
}
?>