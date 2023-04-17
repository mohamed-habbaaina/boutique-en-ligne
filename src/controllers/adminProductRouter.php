<?php
namespace src\controllers;

require_once("./AdminController.php");

$adminController = new AdminController();

if(isset($_GET["fetchProduct"])){
   
    $adminController->getAllProduct();
}

?>