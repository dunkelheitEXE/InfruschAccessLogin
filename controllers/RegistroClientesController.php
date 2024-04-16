<?php
require "src/php/ClientesQuery.php";;
class RegistroClientesController {
    public function registrarCliente($constancia, $nombre, $direccion, $telefono, $email, $password) {
        $connection = new ClientesQuery();
        $stmt = $connection->RegistrarCliente($constancia, $nombre, $direccion, $telefono, $email, $password);
        return $stmt;
    }
}

?>