<?php

use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if(isset($_GET["userId"])){
    $user = new AdminController();
    var_dump($user);
    $result = $user->getInfo($_GET["userId"]);

    var_dump($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?= $result['firstname'] ?></p>
    
</body>
</html>

