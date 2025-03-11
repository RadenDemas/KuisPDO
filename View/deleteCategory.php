<?php
require "../Controller/controller.php";
$controller = new Controller();

$controller->deleteData("categories",$_GET['id']);
header("Location:index.php");
?>
