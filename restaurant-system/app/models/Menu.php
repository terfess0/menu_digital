class Menu {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPlatosDisponibles() {
        $query = "SELECT * FROM plato WHERE disponible = 1";
        $resultado = mysqli_query($this->conexion, $query);
        $platos = [];

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $platos[] = $fila;
        }

        return $platos;
    }

    public function agregarPlato($nombre, $precio, $disponible) {
        $query = "INSERT INTO plato (nombre, precio, disponible) VALUES ('$nombre', '$precio', '$disponible')";
        return mysqli_query($this->conexion, $query);
    }

    public function editarPlato($id, $nombre, $precio, $disponible) {
        $query = "UPDATE plato SET nombre = '$nombre', precio = '$precio', disponible = '$disponible' WHERE id = $id";
        return mysqli_query($this->conexion, $query);
    }

    public function eliminarPlato($id) {
        $query = "DELETE FROM plato WHERE id = $id";
        return mysqli_query($this->conexion, $query);
    }
}