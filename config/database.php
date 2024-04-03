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

    public function getId($table, $user, $token){
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
            if(count($results) > 0 && password_verify($token, $results['token'])) {
                return $results['id'];
            } else { // SINO RETORNAMOS UN MENSAJE DE ERROR
                return "Usuario no existente o la contraseña es incorrecta";
            }
        } catch(\Throwable $e) {
            return "El usario que ingreso es incorrecto";
        }
    }

    public function insertUser($name, $token) {
        // PREPARAMOS LA CONSULTA PARA INGRESAR DATOS A LA TABLA DE USUARIOS ADMINISTRADORES
        $sql = "INSERT INTO infrusch_access(username, token) VALUES(:username, :token)";
        $query = $this->connection->prepare($sql);

        // REEMPLAZAMOS LOS PARAMETROS POR VALORES ADMISIBLES PARA LA TABLA
        $query->bindParam(':username', $name);
        $query->bindParam(':token', $token);

        // VERIFICAMOS QUE SE HAYA EJECUTADO DE MANERA ADECUADA
        if($query->execute()) {
            return "Usuario creado correctamente";
        } else {
            return "Algo ha salido mal";
        }
    }
}

?>