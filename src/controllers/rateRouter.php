<?php

namespace src\controllers;
use src\controllers\ProductController;
session_start();

require_once("./ProductController.php");

$productController = new ProductController();

if(isset($_POST["addRate"])){
    $productController->addRate($_POST["rating"], $_SESSION["user"]["id"], $_POST["id_pro"]);
    
}

if(isset($_GET["fetchRate"])){
    $productController->fetchRate($_GET["fetchRate"]);
}
?>