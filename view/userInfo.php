<?php

use src\controllers\UserController;

require_once('../src/controllers/UserController.php');
$user = new UserController();

if(isset($_GET["userId"])){
    
    $user->getInfo($_GET["userId"]);
}
?>

