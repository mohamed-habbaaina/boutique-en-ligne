<?php
session_start();
// var_dump($_FILES['image']);
// echo '<br>ok<br>';
// var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="./../src/controllers/add_product.js"></script>

    <title>Add Product</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>
        <p id="displayMessage"></p>
        <h1>Ajouter un Produit</h1>
        <form action="./../src/model/add_product.php" method="post" id="addProduct" enctype="multipart/form-data">

            <label for="name">Nom de Produit</label>
            <input type="text" name="name" placeholder="Entrer le nom de Produit">

            <label for="description">Description</label>
            <input type="text" name="description" placeholder="Entrer la description">

            <label for="price">Prix</label>
            <input type="number" name="price" placeholder="Entrer prix">

            <label for="image">Image</label>
            <input type="file" name="image" placeholder="Ajouter une image">
            <small></small>

            <label for="origin">L'Origine</label>
            <input type="text" name="origin" placeholder="Entrer l'origine du produit">

            <label for="category">La Catégorie</label>
            <input type="text" name="category" placeholder="Entrer La catégorie">

            <button>Ajouter</button>

        </form>
    </main>

    <?php require_once('./includes/footer.php'); ?>
</body>
</html>