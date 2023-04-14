<?php

use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if(isset($_GET["userId"])){
    var_dump($_GET["userId"]);
    $user = new AdminController();

    $user->getInfo($_GET["userId"]);
}
?>

