<<<<<<< HEAD
=======
<?php
session_start();

?>
>>>>>>> main
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
=======

    <link rel="stylesheet" href="style/style.css">

>>>>>>> main
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/includes.css">
    <script defer src="./../src/controllers/searchProduct.js"></script>
    <title>Home</title>
</head>
<body>
    <?php require_once "./includes/header.php" ?>

<<<<<<< HEAD
    <main>
        <div id="search">

            <form action="./../src/controllers/searchProduct.js" method="get" id="searchForm">
                <input type="search" name="search" placeholder="Rechercher un Produit ...">
            </form>

            <div id="displayResult">
=======
    <div id="formDisplay">
>>>>>>> main
        <div class="title">
            <h1>START YOUR DAY WITH OUR COFFEE</h1>
        </div>
        <div class="background">
            <img src="../view/img/table1.jpeg" alt="">
        </div>
    </div>
<<<<<<< HEAD

        </div>
    </main>

    <?php require_once "./includes/footer.php" ?>
=======
    

    <main>
        <div id="search">

            <form action="./../src/controllers/searchProduct.js" method="get" id="searchForm">
                <input type="search" name="search" placeholder="Rechercher un Produit ...">
            </form>

            <div id="displayResult"></div>

        </div>
    </main>
    
    <?php require_once "./includes/footer.php" ?>

<script src="./js/auth.js"></script>
>>>>>>> main
</body>

</html>