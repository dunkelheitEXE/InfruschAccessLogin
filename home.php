<?php
session_start();
//DB AND CONTROLLERS
require "config/app.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

//COMPONENTS
include('src/includes/header.php');
?>
<a href="logout.php">logout</a>
<?php
include('src/includes/footer.php');
?>