<?php

namespace src\controllers;

use src\controllers\AdminController;

require_once("./AdminController.php");

$adminController = new AdminController();

if (isset($_GET["fetch"])) {
    $fetch = $_GET["fetch"];
    if ($fetch === "product") {
        $adminController->getProductData();
    }
}

if (isset($_GET["delProduct"])) {
    $adminController->delProduct($_GET['delProduct']);
}

if (isset($_POST['name'])) {
    $adminController->changeName($_POST['id'], $_POST['name']);
}

if (isset($_POST['description'])) {
    $adminController->changeDescription($_POST['id'], $_POST['description']);
}

if (isset($_POST['category'])) {
    $adminController->changeCategory($_POST['id'], $_POST['category']);
}

if (isset($_POST['categoryDescription'])) {
    $adminController->changeCategoryDescription($_POST['id'], $_POST['categoryDescription']);
}

if (isset($_POST['origin'])) {
    $adminController->changeOrigin($_POST['id'], $_POST['origin']);
}

if (isset($_POST['originDescription'])) {
    $adminController->changeOriginDescription($_POST['id'], $_POST['originDescription']);
}

if (isset($_POST['price'])) {
    $adminController->changePrice($_POST['id'], $_POST['price']);
}
