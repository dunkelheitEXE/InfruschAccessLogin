<?php

class DatabaseClients {
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

    public function buscarClientes($search = '') {
        if ($search) {
            $stmt = $this->connection->prepare("SELECT * FROM infrusch_clients WHERE constancia LIKE :search OR nombre LIKE :search OR direccion LIKE :search OR telefono LIKE :search OR email LIKE :search");
            $stmt->execute(['search' => '%' . $search . '%']);
        } else {
            $stmt = $this->connection->query("SELECT * FROM infrusch_clients");
        }
        
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
