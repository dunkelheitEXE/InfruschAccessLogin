<?php
require "src/php/ClientesQuery.php";
class DatosClienteController {
    public function buscarClientes($search = '', $searchType = 'cliente_nombre') {
        $connection = new ClientesQuery();
        $stmt = $connection->BuscarClientes($search, $searchType);
        return $stmt;
    }

    public function selectNombresClientes() {
        $connection = new ClientesQuery();
        $stmt = $connection->SelectNombresClientes();
        return $stmt;
    }
}
?>