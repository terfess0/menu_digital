<?php
session_start();
require_once 'config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Check if the user is logged in
if (isset($_SESSION['id_usuario'])) {
    // Redirect to client dashboard or admin dashboard based on role
    if ($_SESSION['rol'] == 'Administrador') {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: client/menu.php');
    }
} else {
    // If not logged in, redirect to login page
    header('Location: auth/login.php');
}
?>