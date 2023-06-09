<?php
session_start();
use src\Classes\Cart;
require_once('./../src/Classes/Cart.php');
$cart = new cart();

// Secure page
if(!$cart->isConnected())
{
    header("Location: index.php");
    die('Acces refused to the database !!!');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/includes.css">
    <link rel="stylesheet" href="./style/contact.css">
    <link rel="stylesheet" href="./style/cart.css">
    <script defer src="./../src/controllers/get_cart.js"></script>
    <title>Cart</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>
        <h1>Cart</h1>
            <div class="displayCart">
            </div>
            
            <div class="paymentCart">
            </div>
    </main>
    
    <?php require_once('./includes/footer.php'); ?>
</body>
</html>