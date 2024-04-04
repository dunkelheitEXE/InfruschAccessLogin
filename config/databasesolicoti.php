<?php

class DatabaseSolicoti {
    private $user = "root";
    private $host = "localhost";
    private $dbname = "infrusch";
    private $dbpassword = "";
    public $connection;

    public function __construct() {
        $dns = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
        try {
            $this->connection = new PDO($dns, $this->user, $this->dbpassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
    }

    public function insertarSolicitud($cliente, $descripcion) {
        $sql = "INSERT INTO infrusch__solicitud_cotizacion (cliente, descripcion, fecha) VALUES (:cliente, :descripcion, NOW())";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([':cliente' => $cliente, ':descripcion' => $descripcion]);
    }
    
}
