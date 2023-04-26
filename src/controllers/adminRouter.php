<?php

namespace src\controllers;

use src\controllers\AdminController;

require_once("./AdminController.php");

$adminController = new AdminController();

if (isset($_GET["fetch"])) {
    $fetch = $_GET["fetch"];
    if ($fetch === "messages") {
        echo json_encode($adminController->getMessages());
    }
}

if (isset($_GET["delMessage"])) {
    $adminController->delMessage($_GET["delMessage"]);
}

if (isset($_GET["delComment"])) {
    $adminController->delComment($_GET["delComment"]);
}