<?php

if(isset($_POST['submit'])) {
    $ruta="src/database/Docs/".$_FILES['archivo']['name'];
    $mes = $connection->editarConstancia($_GET['clienteid'], $ruta);
    move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

    echo $mes;
    if($mes == "Exito") {
        header('Location: DatosCliente.php');
    }
}
?>