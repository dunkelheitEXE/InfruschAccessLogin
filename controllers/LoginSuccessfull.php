<?php
if(isset($_POST['submit'])) {
    $id = $connection->getId('infrusch_access', $_POST['usuario'], $_POST['password']);
    if($id == "" or $id == null) {
        $message = "Error, usuario no existente";
    } else {
        $_SESSION['user-id'] = $id;
        header('Location: home.php');
    }
}
?>