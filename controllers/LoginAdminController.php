<?php
require "src/php/AdminQuery.php";

class LoginAdminController {
    public function loginAdmin($table, $user, $password) {
        $connection = new AdminQuery();
        $stmt = $connection->LoginAdmin($table, $user, $password);
        return $stmt;
    }
}
?>