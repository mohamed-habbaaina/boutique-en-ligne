<?php

use src\Classes\Product;
use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if (isset($_GET["userId"])) {
    $userId = $_GET['userId'];
    $user = new AdminController();
    $profile = $user->getInfo($userId);
    $orders = $user->getUserOrders($userId);

    $firstname = $profile['firstname'];
    $lastname = $profile['lastname'];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infos <?= $firstname . ' ' . $lastname . ' id: ' . $userId; ?></title>
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <?php require_once("./includes/header.php"); ?>
    <ul>

        <?php foreach ($orders as $order) {
            $id_ord = $order[0]['id_ord'];
            $date_ord = $order[0]['date_ord'];

            echo "<li id=" . $id_ord . '>' . $date_ord;
            echo "<ul>";
            foreach ($order as $product) {
                echo "<li class=productName>" . $product['name_pro'] . " " . $product['quantity'] . " x " . $product['price_pro'] / 100 . " = " . $product['quantity'] * $product['price_pro'] / 100 ."€</li>";
            }
            echo "</ul>";
        }
        ?>
    </ul>
    <p><?= var_dump($profile) ?></p>
    <p><?= var_dump($orders) ?></p>
</body>

</html>