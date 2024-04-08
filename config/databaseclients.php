<?php

class DatabaseClients {
    private $user = "root";
    private $host = "localhost";
    private $dbname = "infrusch";
    private $dbpassword = "";
    public $connection;
    private $searchableFields = ['id', 'nombre', 'email', 'telefono','direccion'];

    public function __construct() {
        $dns = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
        try {
            $this->connection = new PDO($dns, $this->user, $this->dbpassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit("Error de conexión: " . $e->getMessage());
        }
    }

    public function buscarClientes($search = '', $searchType = 'nombre') {
        if (!in_array($searchType, $this->searchableFields)) {
            throw new InvalidArgumentException("Búsqueda no permitida en el campo: $searchType");
        }

        if (!empty($search)) {
            $sql = "SELECT * FROM infrusch_clients WHERE $searchType LIKE :search";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['search' => "%$search%"]);
        } else {
            $stmt = $this->connection->query("SELECT * FROM infrusch_clients");
        }

        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
