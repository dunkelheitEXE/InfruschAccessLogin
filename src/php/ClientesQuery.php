<?php 
class ClientesQuery {
    // DATA BASE INFO
    // INFORMACION SOBRE LA BASE DE DATOS
    private $user = "root";
    private $host = "localhost";
    private $dbname = "infrusch";
    private $dbpassword = "123456789";
    public $connection;

    //METHODS AND CONSTRUCT
    // METODOS Y CONSTRUCTOR
    function __construct()
    {
        $dns = "mysql:host=".$this->host."; dbname=".$this->dbname.";"; //INFORMACION DNS
        $this->connection = new PDO($dns, $this->user, $this->dbpassword); // SET CONNECTION
    }

    public function RegistrarCliente($constancia, $nombre, $direccion, $telefono, $email, $password) {
        try {
            $sql = "INSERT INTO infrusch_clients(cliente_constancia, cliente_nombre, cliente_direccion, cliente_telefono, cliente_email, cliente_password) VALUES(:constancia, :nombre, :direccion, :telefono, :email, :pass)";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':constancia', $constancia);
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':direccion', $direccion);
            $query->bindParam(':telefono', $telefono);
            $query->bindParam(':email', $email);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query->bindParam(':pass', $hashedPassword);
    
            if($query->execute()) {
                return "Cliente Registrado Correctamente!";
            } else {
                return "ERROR";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
            return "ERROR";
        }
    }

    public function BuscarClientes($search = '', $searchType = "cliente_nombre") {
        try{
            if (!empty($search)) {
                $sql = "SELECT cliente_id, cliente_constancia, cliente_nombre, cliente_direccion, cliente_telefono, cliente_email FROM infrusch_clients WHERE $searchType LIKE :search";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->connection->query("SELECT cliente_id, cliente_constancia, cliente_nombre, cliente_direccion, cliente_telefono, cliente_email FROM infrusch_clients");
            }
            
            return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        }catch(\Throwable $e){
            echo $e->getMessage();
        }
    }

    public function ObtenerDatosCliente($id) {
        try{
            $results = [];
            $sql = "SELECT cliente_id, cliente_constancia, cliente_nombre, cliente_direccion, cliente_telefono, cliente_email FROM infrusch_clients WHERE cliente_id = :id";
            $query=$this->connection->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $results = $query->fetch(PDO::FETCH_ASSOC);
            if(count($results) > 0) {
                return $results;
            } else {
                return null;
            }
        } catch (\Throwable $e) {
            echo $e;
        }
    }

    public function EditarCliente($nombre, $direccion, $telefono, $email, $id) {
        try{
            // Creamos la consulta para actualizar los datos basicos del cliente
            $sql = "UPDATE infrusch_clients SET cliente_nombre=:nombre, cliente_direccion=:direccion, cliente_telefono = :telefono, cliente_email = :email WHERE cliente_id=:id";

            // PREPARAMOS LA SENTENCIA
            $query = $this->connection->prepare($sql);

            // SI EJECUTA DE MANERA ADECUADA, DEVOLVERA UN MENSAJE DE CONFIRMACION
            if($query->execute([':nombre' => $nombre, ':direccion' => $direccion, ':telefono' => $telefono, ':email' => $email, 'id' => $id])) {
                return "Datos del cliente Actualizados!";
            } else {
                return "ERROR";
            }
        }catch(\Throwable $e) {
            echo $e;
            return "ERROR";
        }
    }

    public function EditarConstancia($id, $constancia) {
        try{
            $query = $this->connection->prepare("UPDATE infrusch_clients SET cliente_constancia = :constancia WHERE cliente_id = :id");
            if($query->execute([':constancia' => $constancia, ':id' => $id])) {
                return "Exito";
            } else {
                return "ERROR";
            }
        } catch (\Throwable $th)
        {
            echo $th;
            return "ERROR";
        }
    }

    public function EliminarCliente($id) {
        try{
            $sql = "DELETE FROM infrusch_clients WHERE cliente_id = :id";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':id', $id);
            if($query->execute()) {
                return "Cliente Eliminado";
            } else {
                return "ERROR";
            }
        } catch(\Throwable $e) {
            echo $e;
            return "ERROR";
        }
    }

    public function EditarPassword($id, $password) {
        try {
            //code...
            $passwordEncripted = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE infrusch_clients SET cliente_password = :pass WHERE cliente_id = :id";
            $query = $this->connection->prepare($sql);
            if($query->execute([':pass' => $passwordEncripted, ':id' => $id])) {
                return "Edicion correcta";
            } else {
                return "ERROR";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
            return "ERROR";
        }
    }
}
?>