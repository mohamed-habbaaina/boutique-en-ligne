<?php
session_start();
require_once('../src/Classes/Cart.php');

$user = new \src\Classes\Cart;
if(!$user->isConnected())
{
    header('Location: index.php');
    die('Acces refused to the database !!!');
}

if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin')
{
    header('Location: ./index.php');
    die('Acces refused to the database !!!');
}


// if (isset($_SESSION["user"]))
// {
//     if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin')
//     {
//         header('Location: ./index.php');
//         die('Acces refused to the database !!!');
//     }

// }

?>

<!DOCTYPE html>
<html lang="fr">

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