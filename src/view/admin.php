<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/admin.css">
    <title>Admin ALGUAMO</title>
</head>

<body>

    <?php require_once "./includes/header.php" ?>

    <main>

    <?php
    if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') {
        echo "Access denied, you have to be admin";
        die();
    }
    ?>
    <h1>Admin</h1>
        <div class="buttonDiv">
        <button id="productDisplayBtn" class="button-59">Products</button>
        <button id="userDisplayBtn" class="button-59">Users</button>
        <button id="messageDisplayBtn" class="button-59">Message</button>
        </div>
        <div id="userDisplay">
            <h1>USERS</h1>

        </div>

        <div id="productDisplay">
            <h1>PRODUCTS</h1>

        </div>

        <div id="messageDisplay">
            <h1>MESSAGES</h1>
        </div>

        <div id="contentDisplay"></div>

        <script src="./js/admin.js"></script>

    </main>
</body>

</html>