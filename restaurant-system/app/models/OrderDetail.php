class OrderDetail {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function addItemToOrder($orderId, $menuItemId, $quantity) {
        $query = "INSERT INTO order_detail (order_id, menu_item_id, quantity) VALUES ('$orderId', '$menuItemId', '$quantity')";
        return mysqli_query($this->connection, $query);
    }

    public function getOrderDetails($orderId) {
        $query = "SELECT od.*, m.name AS menu_item_name FROM order_detail od JOIN menu m ON od.menu_item_id = m.id WHERE od.order_id = '$orderId'";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function removeItemFromOrder($orderId, $menuItemId) {
        $query = "DELETE FROM order_detail WHERE order_id = '$orderId' AND menu_item_id = '$menuItemId'";
        return mysqli_query($this->connection, $query);
    }
}