<?php
require "src/php/ClientesQuery.php";
class EditarClienteController {
    public function obtenerDatosCliente($id) {
        $connection = new ClientesQuery();
        $results = $connection->ObtenerDatosCliente($id);
        return $results;
    }
    public function editarCliente($nombre, $direccion, $telefono, $email, $id) {
        $connection = new ClientesQuery();
        $stmt = $connection->EditarCliente($nombre, $direccion, $telefono, $email, $id);
        return $stmt;
    }

    public function editarConstancia($id, $constancia) {
        $connection = new ClientesQuery();
        $stmt = $connection->EditarConstancia($id, $constancia);
        return $stmt;
    }

    public function editarPassword($id, $password) {
        $connection = new ClientesQuery();
        $stmt = $connection->EditarPassword($id, $password);
        return $stmt;
    }
}

?>