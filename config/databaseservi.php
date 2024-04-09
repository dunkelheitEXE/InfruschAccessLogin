<?php

class DatabaseServi {
    private $user = "root";
    private $host = "localhost";
    private $dbname = "infrusch";
    private $dbpassword = "";
    public $connection;

    public function __construct() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $this->user, $this->dbpassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit("Error de conexión: " . $e->getMessage());
        }
    }

    // Función para insertar una nueva cotización en la base de datos
    public function insertarCotizacion($cliente, $descripcion, $archivo, $fecha) {
        $sql = "INSERT INTO nombre_tabla_cotizaciones (cliente, descripcion, archivo, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$cliente, $descripcion, $archivo, $fecha]);
    }
    

    // Función para obtener los servicios pendientes
    public function obtenerServiciosPendientes() {
        $sql = "SELECT * FROM infrusch_Servicios WHERE estado_servicio = 'pendiente'";
        $stmt = $this->connection->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}

?>
