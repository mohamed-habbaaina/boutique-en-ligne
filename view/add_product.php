<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>
        <h1>Ajouter un Produit</h1>
        <form action="./../src/model/add_product.php" method="post" id="addProduct">

            <input type="text" name="name" placeholder="Le nom de Produit">
            <small></small>

            <input type="text" name="description" placeholder="La description">
            <small></small>

            <input type="number" name="price" placeholder="Le prix">
            <small></small>

            <input type="file" name="image" placeholder="Ajouter une image">
            <small></small>

            <input type="text" name="origin" placeholder="L'origine du produit">
            <small></small>

            <input type="text" name="category" placeholder="La catégorie">
            <small></small>

            <button>Ajouter</button>

        </form>
    </main>

    <?php require_once('./includes/footer.php'); ?>
</body>
</html>