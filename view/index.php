<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <title>Home</title>
</head>

<body>
    <?php require_once "./includes/header.php" ?>
    <main>

        <div id="displayResult"></div>
        </div>

        <div id="formDisplay">
            <div class="background">
                <img src="../view/img/homepage.jpg" alt="">
            </div>
            <div class="title">
                <h1>START YOUR DAY WITH OUR COFFEE</h1>
            </div>
        </div>
    </main>
    <div class="aboutShop">
        <div class="displayAboutShop">

            <div class="aboutshopTextLeft">
                <p>You’ll be greeted by stunning smells of our coffee beans, exquisite flavors and rich, smooth textures.</p>
                <hr>
            </div>
            <div class="imgRight">
                <img src="./img/coffeeFarm.jpeg">
            </div>
        </div>
        <div class="displayAboutShop">
            <div class="imgLeft">
                <img src="./img/freshcoffeebean.webp">
            </div>
            <div class="aboutshopTextRight">
                <p>We’re commited to using only the freshest, highest quality for our shop, our beans are carefully selected from the finest coffee-growing regions around the world.</p>
                <hr>
            </div>
        </div>
    </div>
    <div class="mostLiked">
        <h1 class ="indexTitle">YOUR FAVORITE BEANS</h1>
        <div class="grid-container">

            <div class="gridProduct">


            </div>

        </div>
    </div>
    <?php require_once "./includes/footer.php" ?>

    <script src="./js/auth.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>