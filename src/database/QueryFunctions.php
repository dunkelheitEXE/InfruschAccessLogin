<?php
class QueryFunctions {
    //ATTRIBUTES

    //METHODS
    public static function passwordConfirmation($password, $confirm) {
        if($password != $confirm) {
            return "La contraseña no ha sido confirmada de manera adecuada";
        } else {
            return "";
        }
    }
}
?>