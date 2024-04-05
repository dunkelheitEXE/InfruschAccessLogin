<?php
session_start();
require "config/Database.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

include("src/includes/header.php");
include("src/includes/components/ComHome.php");
include("src/includes/footer.php");
?>