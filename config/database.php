<?php

class Database {
    private $user = "root";
    private $host = "localhost";
    private $dbname = "infrusch";
    private $dbpassword = "";
    public $connection;

    function __construct() {
        $dns = "mysql:host=".$this->host."; dbname=".$this->dbname.";";
        $this->connection = new PDO($dns, $this->user, $this->dbpassword);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getId($table, $user, $password){
        $results = ""; // DEFINE RETURN VARIABLE TO SAVE DATA USER - vARIABLE PARA DATOS DE USUARIO
        //$error_mes=""; // 

        // PREPARAMOS LA CONSULTA PARA OBTENER EL ID DEL CLIENTE
        $sql = "SELECT * FROM $table WHERE username=:username";
        $query=$this->connection->prepare($sql);

        // REEMPLAZAMOS PARAMETROS (el nombre del usuario = :username)
        $query->bindParam(':username', $user);
        try{ // PREVENIMOS ERRORES
            $query->execute();
            $results = $query->fetch(PDO::FETCH_ASSOC);// GUARDAMOS EN UN ARREGLO LOS DATOS DEL USUARIO

            //COMPROBAMOS QUE HAYA DATOS EXISTENTES Y QUE LA CONTRASEÑA SEA ADECUADA
            if(count($results) > 0 && password_verify($password, $results['token'])) {
                return $results['id'];
            } else { // SINO RETORNAMOS UN MENSAJE DE ERROR
                return "";
            }
        } catch(\Throwable $e) {
            return "";
        }
    }

    public function insertUserAdmin($username, $password) {
        // PREPARAMOS LA CONSULTA PARA INGRESAR DATOS A LA TABLA DE USUARIOS ADMINISTRADORES
        $sql = "INSERT INTO infrusch_access(username, token) VALUES(:username, :pass)";
        try {
            $query = $this->connection->prepare($sql);

            // REEMPLAZAMOS LOS PARAMETROS POR VALORES ADMISIBLES PARA LA TABLA
            $query->bindParam(':username', $username);
            $query->bindParam(':pass', $password);

            // VERIFICAMOS QUE SE HAYA EJECUTADO DE MANERA ADECUADA
            if($query->execute()) {
                return "<div class='tg tg-success'>Usuario creado correctamente</div>";
            } else {
                return "<div class='tg tg-danger'>Algo ha salido mal</div>";
            }
        } catch (\Throwable $e) {
            return "<div class='tg tg-danger'>Algo ha salido mal</div>";
        }
        
    }

    public function verificarExistencia($user, $table) {
        $state = true;
        $sql = "SELECT * FROM $table";
        $query=$this->connection->prepare($sql);
        $query->execute();
        while ($verificador = $query->fetch()){
            if($user == $verificador['username']){
                $state=false;
                break;
            } else {
                continue;
            }
        }

        return $state;
    }

    public function insertCliente($constancia, $nombre, $direccion, $telefono, $email, $password) {
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
            return "<div class='tg tg-success'>Cliente registrado correctamente</div>";
        } else {
            return "<div class='tg tg-danger'>Algo ha salido mal</div>";
        }
    }

    public function buscarClientes($search = '', $searchType = "cliente_nombre") {
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

    public function getClienteData($id) {
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

    public function editCliente($nombre, $direccion, $telefono, $email, $id) {
        try{
            $sql = "UPDATE infrusch_clients SET cliente_nombre=:nombre, cliente_direccion=:direccion, cliente_telefono = :telefono, cliente_email = :email WHERE cliente_id=:id";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':direccion', $direccion);
            $query->bindParam(':telefono', $telefono);
            $query->bindParam(':email', $email);
            $query->bindParam(':id', $id);
            if($query->execute()) {
                return "<div class='tg tg-success'>Cliente registrado correctamente</div>";
            } else {
                return "<div class='tg tg-danger'>Error</div>";
            }
        }catch(\Throwable $e) {
            return $e;
        }
    }

    public function deleteCliente($id) {
        try{
            $sql = "DELETE FROM infrusch_clients WHERE cliente_id = :id";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':id', $id);
            if($query->execute()) {
                return "<div class='tg tg-success'>Cliente eliminado correctamente</div>";
            } else {
                return "<div class='tg tg-danger'>Error</div>";
            }
        } catch(\Throwable $e) {
            return $e;
        }
    }
}

?>
