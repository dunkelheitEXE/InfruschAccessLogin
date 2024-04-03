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

    public function getId($table, $user, $token){
        $sql = "SELECT * FROM $table WHERE username=:username";
        $query = $this->connection->prepare($sql);
        $query->bindParam(':username', $user);

        try {
            $query->execute();
            $results = $query->fetch(PDO::FETCH_ASSOC);
            if ($results && password_verify($token, $results['token'])) {
                session_start();
                $_SESSION['user_id'] = $results['id'];
                $_SESSION['username'] = $user;

                header('Location: menuinfrusch.php');
                exit;
            } else {
                return false;
            }
        } catch (\Throwable $e) {
            return false;
        }
    }
}

?>
