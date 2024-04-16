<?php
//CONTROLLERS and DB
session_start();
require "config/app.php";
if(isset($_SESSION['user-id'])) {
    header('Location: home.php');
}

include("src/includes/header.php");
include("src/includes/footer.php");
?>