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

if(isset($_GET["mostLiked"])){
    $productController->getMostLiked();
}

if(isset($_GET["fetchCategory"])){
    $productController->getCategory();
}

if(isset($_GET["fetchOrigin"])){
    $productController->getOrigin();
}

// if(isset($_POST["displayCategory"])){
//     $productController->displayCategory($_POST["displayCategory"]);
// }

if (isset($_POST['filterCategory']) && isset($_POST['filterOrigin'])) {
    $productController->displayFilter($_POST['filterCategory'], $_POST['filterOrigin']);
}

?>