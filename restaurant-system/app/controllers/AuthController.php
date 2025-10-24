<?php
session_start();
require_once '../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

            if ($this->userModel->insertarUsuario($nombre, $telefono, $direccion, $email, $contrasena)) {
                header('Location: ../views/auth/login.php');
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            $usuario = $this->userModel->obtenerUsuarioPorEmail($email);
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['rol'] = $usuario['rol'];
                header('Location: ../views/client/menu.php');
            } else {
                echo "Email o contraseña incorrectos.";
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../views/auth/login.php');
    }
}
?>