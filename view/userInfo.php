<?php

use src\controllers\UserController;

require_once('../src/controllers/UserController.php');
session_start();

if(isset($_GET["getUserInfo"])){
    var_dump($_GET["getUserInfo"]);
    $user = new UserController();

    $user->getInfo($_GET["getUserInfo"]);
}
?>

