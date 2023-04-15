<?php

use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if(isset($_GET["userId"])){
    $userId = $_GET['userId'];
    $user = new AdminController();
    $profile = $user->getInfo($userId);
    $purshases = $user->getUserPurshases($userId);
}
?>
<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Info user <?= $profile['id-user']; ?></title>
        <link rel="stylesheet" href="style/contact.css">
        <link rel="stylesheet" href="style/includes.css">
        <link rel="stylesheet" href="style/style.css">
    </head>
    
    <body>
        
        <?php require_once("./includes/header.php"); ?>
        
        <p><?= var_dump($profile) ?></p>
        <p><?= $profile['firstname'] ?></p>
        <p><?= var_dump($purshases) ?></p>
</body>
</html>

