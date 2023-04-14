<?php

use src\controllers\UserController;

require_once('../src/controllers/UserController.php');
session_start();

if(isset($_GET["userId"])){
    var_dump($_GET["userId"]);
    $user = new UserController();

    $user->getInfo($_GET["userId"]);
}
?>

