class User {
    private $connection;

    public function __construct() {
        include_once 'app/models/Connection.php';
        $this->connection = $connection;
    }

    public function register($name, $phone, $address, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario (nombre, telefono, direccion, email, contrasena, rol) VALUES ('$name', '$phone', '$address', '$email', '$hashedPassword', 'Cliente')";
        return mysqli_query($this->connection, $query);
    }

    public function login($email, $password) {
        $query = "SELECT * FROM usuario WHERE email = '$email'";
        $result = mysqli_query($this->connection, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['contrasena'])) {
                return $user;
            }
        }
        return false;
    }

    public function getUserOrders($userId) {
        $query = "SELECT p.*, ep.estado FROM pedido p JOIN estado_pedido ep ON p.id_estado = ep.id_estado WHERE p.id_usuario = '$userId'";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}