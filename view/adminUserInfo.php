<?php

use src\Classes\Product;
use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if (isset($_GET["userId"])) {
    $userId = $_GET['userId'];
    $adminController = new AdminController();
    $profile = $adminController->getUserInfo($userId);
    $orders = $adminController->getUserOrders($userId);

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
    <script src="./js/adminUserInfo.js" defer></script>
</head>

<body>

    <?php require_once("./includes/header.php"); ?>
    <main>

        <ul>

            <h3>Info utilisateur</h3>

            <table>
                <tr>
                    <td>Id</td>
                    <td><?= $profile['id_user'] ?></input></td>
                </tr>
                <tr>
                    <form action="" id="firstnameForm" class="changeForm">
                        <input type="hidden" value="<?= $profile['id_user'] ?>" name="id">
                        <td><label for="firstname">Firstname</label></td>
                        <td><input type="text" value="<?= $profile['firstname'] ?>" id="firstname" name="firstname"></input></td>
                        <td><input type="submit" value="change"></td>
                    </form>
                </tr>
                <tr>
                    <form action="" id="lastnameForm" class="changeForm">
                        <input type="hidden" value="<?= $profile['id_user'] ?>" name="id">
                        <td><label for="lastname">Lastname</label></td>
                        <td><input type="text" value="<?= $profile['lastname'] ?>" id="lastname" name="lastname"></input></td>
                        <td><input type="submit" value="change"></td>
                    </form>
                </tr>
                <tr>
                    <form action="" id="emailForm" class="changeForm">
                        <input type="hidden" value="<?= $profile['id_user'] ?>" name="id">
                        <td><label for="email">E-mail</label></td>
                        <td><input type="text" value="<?= $profile['email'] ?>" id="email" name="email"></input></td>
                        <td><input type="submit" value="change"></td>
                    </form>
                </tr>
                <tr>
                    <form action="" id="passwordForm" class="changeForm">
                        <input type="hidden" value="<?= $profile['id_user'] ?>" name="id">
                        <td><label for="password">Password</label></td>
                        <td><input type="password" placeholder="**********" id="lastname" name="password"></input></td>
                        <td><input type="submit" value="change"></td>
                    </form>
                </tr>
                <tr>
                    <form action="" id="addressForm" class="changeForm">
                        <input type="hidden" value="<?= $profile['id_user'] ?>" name="id">
                        <td><label for="address">Address</label></td>
                        <td><input type="text" value="<?= $profile['address_cus'] ?>" id="address" name="address"></br>
                            </input><input type="text" value="<?= $profile['zip_cus'] ?>" id="zip" name="zip"></input></td>
                        <td><input type="submit" value="change"></td>
                    </form>
                </tr>
                <tr>
                    <form action="" id="phoneForm" class="changeForm">
                        <input type="hidden" value="<?= $profile['id_user'] ?>" name="id">
                        <td><label for="phone">Phone</label></td>
                        <td><input type="text" value="<?= $profile['phone_cus'] ?>" id="phone" name="phone"></input></td>
                        <td><input type="submit" value="change"></td>
                    </form>
                </tr>
            </table>

            <h3>Commandes utilisateur</h3>

            <?php foreach ($orders as $order) {
                $id_ord = $order[0]['id_ord'];
                $date_ord = $order[0]['date_ord'];

                echo "<li id=" . $id_ord . '>' . $date_ord;
                echo "<ul>";
                foreach ($order as $product) {
                    echo "<li class=productName>" . $product['name_pro'] . " " . $product['quantity'] . " x " . $product['price_pro'] / 100 . " = " . $product['quantity'] * $product['price_pro'] / 100 . "€</li>";
                }
                echo "</ul>";
            }
            ?>
        </ul>
    </main>
</body>

</html>