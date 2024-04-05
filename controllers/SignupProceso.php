<?php
if(isset($_POST['submit'])) {
    $state = $connection->verificarExistencia($_POST['usuario']);
    if($_POST['password'] != $_POST['confirmation']) {
        $message = "<div class='tg tg-danger'>No ha confirmado la contraseña de manera adecuada</div>";
    } else {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $message=$connection->insertUser($_POST['usuario'], $password);
    }

    echo $message;
}
?>