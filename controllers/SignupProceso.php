<?php
if(isset($_POST['submit'])) {
    $state = $connection->verificarExistencia($_POST['usuario'], 'infrusch_access');
    if($_POST['password'] != $_POST['confirmation']) {
        $message = "<div class='tg tg-danger'>No ha confirmado la contraseña de manera adecuada</div>";
    } else if($state == false) {
        $message = "<div class='tg tg-danger'>El usuario ya existe!</div>";
    } else {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $message=$connection->insertUserAdmin($_POST['usuario'], $password);
    }

    echo $message;
}
?>