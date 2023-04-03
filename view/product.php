<?php
session_start();
if(isset($_GET['idProduct'])):
$_SESSION['idProduct'] = $_GET['idProduct'];
endif;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/product.css">
    <title>Product</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>

    </main>

    <?php require_once('./includes/footer.php'); ?>

</body>
</html>