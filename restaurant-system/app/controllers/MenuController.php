<?php
class MenuController {
    private $menuModel;

    public function __construct() {
        require_once '../models/Menu.php';
        $this->menuModel = new Menu();
    }

    public function listMenuItems() {
        $items = $this->menuModel->getAvailableDishes();
        require '../views/admin/manage-menu.php';
    }

    public function addMenuItem($name, $description, $price, $available) {
        $this->menuModel->insertMenuItem($name, $description, $price, $available);
        header('Location: ../views/admin/manage-menu.php');
    }

    public function editMenuItem($id, $name, $description, $price, $available) {
        $this->menuModel->updateMenuItem($id, $name, $description, $price, $available);
        header('Location: ../views/admin/manage-menu.php');
    }

    public function deleteMenuItem($id) {
        $this->menuModel->deleteMenuItem($id);
        header('Location: ../views/admin/manage-menu.php');
    }
}
?>