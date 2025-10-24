<?php
session_start();
require_once 'app/config/config.php';
require_once 'app/config/database.php';

// Simple routing
$requestUri = $_SERVER['REQUEST_URI'];

if (strpos($requestUri, '/admin') === 0) {
    require_once 'app/controllers/AuthController.php';
    require_once 'app/controllers/MenuController.php';
    require_once 'app/controllers/OrderController.php';
    require_once 'app/controllers/UserController.php';
    // Handle admin routes
    // Example: Admin dashboard
    if ($requestUri === '/admin/dashboard') {
        // Load admin dashboard
        require 'app/views/admin/dashboard.php';
    } elseif ($requestUri === '/admin/manage-menu') {
        // Load manage menu
        require 'app/views/admin/manage-menu.php';
    } elseif ($requestUri === '/admin/manage-orders') {
        // Load manage orders
        require 'app/views/admin/manage-orders.php';
    }
} elseif (strpos($requestUri, '/client') === 0) {
    require_once 'app/controllers/AuthController.php';
    require_once 'app/controllers/MenuController.php';
    require_once 'app/controllers/OrderController.php';
    require_once 'app/controllers/UserController.php';
    // Handle client routes
    // Example: Client menu
    if ($requestUri === '/client/menu') {
        // Load client menu
        require 'app/views/client/menu.php';
    } elseif ($requestUri === '/client/cart') {
        // Load client cart
        require 'app/views/client/cart.php';
    } elseif ($requestUri === '/client/my-orders') {
        // Load client orders
        require 'app/views/client/my-orders.php';
    } elseif ($requestUri === '/client/register') {
        // Load registration form
        require 'app/views/client/register.php';
    } elseif ($requestUri === '/auth/login') {
        // Load login form
        require 'app/views/auth/login.php';
    }
} else {
    // Default route
    require 'app/views/client/menu.php';
}
?>