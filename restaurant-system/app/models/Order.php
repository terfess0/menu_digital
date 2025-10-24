class Order {
    private $connection;

    public function __construct() {
        include_once 'Connection.php';
        $this->connection = new Connection();
    }

    public function createOrder($userId, $totalAmount) {
        $query = "INSERT INTO pedido (id_usuario, total) VALUES ('$userId', '$totalAmount')";
        return mysqli_query($this->connection->getConnection(), $query);
    }

    public function getOrdersByUserId($userId) {
        $query = "SELECT p.id_pedido, p.fecha, p.total, ep.nombre AS estado 
                  FROM pedido p 
                  JOIN estado_pedido ep ON p.id_estado = ep.id_estado 
                  WHERE p.id_usuario = '$userId'";
        $result = mysqli_query($this->connection->getConnection(), $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getOrderDetails($orderId) {
        $query = "SELECT pd.cantidad, pl.nombre, pl.precio 
                  FROM pedido_detalle pd 
                  JOIN plato pl ON pd.id_plato = pl.id_plato 
                  WHERE pd.id_pedido = '$orderId'";
        $result = mysqli_query($this->connection->getConnection(), $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}