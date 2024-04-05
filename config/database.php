<?php

class Database {
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

    public function insertUser($username, $password) {
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

    public function verificarExistencia($user) {
        $state = true;
        $sql = "SELECT * FROM infrusch_access";
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
}

?>