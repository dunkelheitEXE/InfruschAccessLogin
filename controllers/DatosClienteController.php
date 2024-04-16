<?php
require "src/php/ClientesQuery.php";
class DatosClienteController {
    public function buscarClientes($search = '', $searchType = 'cliente_nombre') {
        $connection = new ClientesQuery();
        $stmt = $connection->BuscarClientes($search, $searchType);
        return $stmt;
    }
}
?>