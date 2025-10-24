<?php
class OrderController {
    private $orderModel;

    public function __construct() {
        require_once '../models/Order.php';
        $this->orderModel = new Order();
    }

    public function createOrder($userId, $orderDetails) {
        $orderId = $this->orderModel->insertOrder($userId);
        foreach ($orderDetails as $detail) {
            $this->orderModel->insertOrderDetail($orderId, $detail['plato_id'], $detail['cantidad']);
        }
        return $orderId;
    }

    public function viewOrders($userId) {
        return $this->orderModel->getOrdersByUser($userId);
    }

    public function changeOrderStatus($orderId, $statusId) {
        return $this->orderModel->updateOrderStatus($orderId, $statusId);
    }
}
?>