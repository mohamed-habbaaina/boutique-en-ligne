<?php

use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if (isset($_GET["messageId"])) {
    $messageId = $_GET['messageId'];
    $adminController = new AdminController();
    $data = $adminController->getMessage($messageId);
}

var_dump($data);