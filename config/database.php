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

    //public function insertInto($table, $fields){}

    public function getId($table, $user, $token){
        $results = "";
        $error_mes="";
        $sql = "SELECT * FROM $table WHERE username=:username AND token=:token";
        $query=$this->connection->prepare($sql);
        $query->bindParam(':username', $user);
        $tokenEncripted = sha1($token);
        $query->bindParam(':token', $tokenEncripted);
        try{
            $query->execute();
            $results = $query->fetch(PDO::FETCH_ASSOC);
            if(count($results) > 0) {
                return $results['id'];
            } else {
                return "Error";
            }
        } catch(\Throwable $e) {
            $error_mes = "Something was wrong";
            return $error_mes;
        }

        if(count($results) > 0) {
            return $results['id'];
        }
    }
}

?>