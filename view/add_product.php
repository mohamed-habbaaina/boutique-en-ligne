<?php
session_start();
if (isset($_SESSION["user"]))
{
    if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin')
    {
        header('Location: ./index.php');
        die('Acces refused to the database !!!');
    }

}

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
    <link rel="stylesheet" href="style/add_product.css">
    <script defer src="./../src/controllers/add_product.js"></script>

    <title>Add Product</title>
</head>

<body>
    <?php require_once('./includes/header.php'); ?>

    <main class="addProduct">
        <h1>Ajouter un Produit</h1>
        <p id="displayMessage"></p>
        <div class="addProductDisplay">
            <form action="./../src/model/add_product.php" method="post" id="addProduct" enctype="multipart/form-data" class="form">
                <div id="contact_form">
                    <div class="input_container">
                        <input type="text" name="name" placeholder="">
                        <label for="name">Nom de Produit</label>
                    </div>
                    <div class="input_container">
                        <input type="text" name="description" placeholder="">
                        <label for="description">Description</label>
                    </div>
                    <div class="input_container">
                        <input type="number" name="price" placeholder="">
                        <label for="price">Prix</label>
                    </div>
                    <div class="input_container">
                        <input type="file" name="image" placeholder="">
                        <label for="image">Image</label>
                        <small></small>
                    </div>
                    <div class="input_container">
                        <input type="text" name="origin" placeholder="">
                        <label for="origin">L'Origine</label>
                    </div>
                    <div class="input_container">
                        <input type="text" name="origin_descript" placeholder="">
                        <label for="origin_descript">Description sur l'origine</label>
                    </div>
                    <div class="input_container">
                        <input type="text" name="category" placeholder="">
                        <label for="category">La Catégorie</label>
                    </div>
                    <div class="input_container">
                        <input type="text" name="category_descript" placeholder="">
                        <label for="category_descript">Description de la catégorie</label>
                    </div>
                    <div id="submit_form">
                        <button class="button-59">Ajouter</button>
                    </div>
            </form>
        </div>
        </div>
    </main>

    <?php require_once('./includes/footer.php'); ?>
</body>

</html>