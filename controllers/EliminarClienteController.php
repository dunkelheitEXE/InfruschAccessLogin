<?php
require "src/php/ClientesQuery.php";
class EliminarClienteController {
    public function eliminarCliente($id) {
        $connection = new ClientesQuery();
        $stmt = $connection->EliminarCliente($id);
        if($stmt != "ERROR") {
            header('Location: DatosCliente.php');
        } else {
            echo '<div class="tg tg-danger">Error al intentar eliminar, verifique su conexión</div>';
        }
    }
}
?>