<?php
    require "../Controller/controller.php";
    $controller = new Controller();

    $controller->deleteData("products",$_GET['id']);
    header("Location:index.php");
?>
