<?php
session_start();

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
    <script defer src="./../src/controllers/searchProduct.js"></script>
    <title>Home</title>
</head>
<body>
    <?php require_once "./includes/header.php" ?>

    <main>
        <div id="formDisplay">
        
            <div id="search">
    
                <form action="./../src/controllers/searchProduct.js" method="get" id="searchForm">
                    <input type="search" name="search" placeholder="Rechercher un Produit ...">
                </form>
    
                <div id="displayResult"></div>
    
            </div>
        <div class="title">
            <h1>START YOUR DAY WITH OUR COFFEE</h1>
        </div>
        <div class="background">
            <img src="../view/img/table1.jpeg" alt="">
        </div>
    </div>
    </main>
    
    <?php require_once "./includes/footer.php" ?>

<script src="./js/auth.js"></script>
</body>

</html>