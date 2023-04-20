<?php

use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if (isset($_GET["productId"])) {
    $productId = $_GET['productId'];
    $adminController = new AdminController();
    $data = $adminController->getProductInfo($productId);

    $name = $data['name_pro'];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infos <?= $name; ?></title>
    <!-- <link rel="stylesheet" href="style/contact.css"> -->
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="./js/adminProductInfo.js" defer></script>
</head>

<body>

    <?php require_once("./includes/header.php"); ?>

        <h3>Info produit</h3>
        <table>
            <tr>
                <td>Id</td>
                <td><?= $data['id_pro'] ?></input></td>
            </tr>
            <tr>
                <form action="" id="nameForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro']?>" name="id">
                    <td><label for="name">Name</label></td>
                    <td><input type="text" value="<?= $data['name_pro'] ?>" id="name" name="name"></input></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="descriptionForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro'] ?>" name="id">
                    <td><label for="description">Description</label></td>
                    <td><textarea type="text" id="description" name="description"><?= $data['description_pro'] ?></textarea></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="categoryForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro'] ?>" name="id">
                    <td><label for="category">Category</label></td>
                    <td><input type="text" value="<?= $data['category_pro'] ?>" id="category" name="category"></input></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="categoryDescriptionForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro'] ?>" name="id">
                    <td><label for="categoryDescription">Category Description</label></td>
                    <td><textarea type="text" id="categoryDescription" name="categoryDescription"><?= $data['category_descript'] ?></textarea></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="originForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro'] ?>" name="id">
                    <td><label for="origin">Origin</label></td>
                    <td><input type="text" value="<?= $data['origin_pro'] ?>" id="origin" name="origin"></input></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="originDescriptionForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro'] ?>" name="id">
                    <td><label for="originDescription">Origin Description</label></td>
                    <td><textarea type="text" id="originDescription" name="originDescription"><?= $data['origin_descript'] ?></textarea></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="priceForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro']?>" name="id">
                    <td><label for="price">price</label></td>
                    <td><input type="text" value="<?= $data['price_pro'] ?>" id="price" name="price"></input></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
            <tr>
                <form action="" id="imageForm" class="changeForm">
                    <input type="hidden" value="<?= $data['id_pro']?>" name="id">
                    <td><label for="image">image</label></td>
                    <td><?= $data['image_pro'] ?><br><input type="file" value="<?= $data['image_pro'] ?>" id="image" name="image"></input></td>
                    <td><input type="submit" value="change"></td>
                </form>
            </tr>
        </table>