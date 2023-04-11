<?php
session_start();
var_dump($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/includes.css">
    <title>Home</title>
</head>

<body>
    <?php require_once "./includes/header.php" ?>
    <div id="formDisplay"></div>
    <div class="background">
        <img src="../view/img/indexpic.jpg" alt="">
    </div>
    <script src="./js/auth.js"></script>
</body>
</html>