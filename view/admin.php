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
    
        <button id="productDisplayBtn">Products</button>
        <button id="userDisplayBtn">Users</button>
        <button id="commentDisplayBtn">Comments</button>
        <button id="messageDisplayBtn">Message</button>

        <div id="userDisplay">
            <p>USERS</p>
        </div>
        
        <div id="productDisplay">
            <p>PRODUCTS</p>
        </div>

        <div id="messageDisplay">
            <p>MESSAGES</p>
        </div>

        <div id="contentDisplay"></div>

        <script src="./js/admin.js"></script>

    </main>
</body>

</html>