<?php
if(isset($_POST['submit'])){
    $password = $_POST['password'];
    if(strlen($password) < 8) {
        $message = "La contraseña debe tener al menos 8 caracteres";
    } else {
        if(!preg_match('/[a-zA-Z0-9]/', $password)) {
            $message = "La contraseña no debe tener caracteres especiales";
        } else {
            $message="";
        }
    }
}

?>