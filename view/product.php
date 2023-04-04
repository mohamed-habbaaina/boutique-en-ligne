<?php
session_start();
require_once('./../src/Classes/Product.php');
$product = new src\Classes\Product();

// Get id product or give a default id.
if(isset($_GET['idProduct'])):
    $idProduct = $_GET['idProduct'];
else:
    $idProduct = 1;
endif;

$dataProduct =  $product->getProduct($idProduct);

// get data product where id & customer rating
$name = $dataProduct['name_pro'];
$description = $dataProduct['description_pro'];
$price = $dataProduct['price_pro'];
$image = $dataProduct['image_pro'];
$origin = $dataProduct['origin_pro'];
$category = $dataProduct['category_pro'];
$avg_rating = number_format($dataProduct['avg_rating'],2);

// var_dump("name : $name, description : $description, price : $price, origin : $origin, category : $category, avg_rating : $avg_rating")

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

        <div>
            <h3><?= $name; ?></h3>
            <!-- add path image -->
            <img src="./../<?= $image; ?>" alt="<?= $name; ?>">
            <p><?= $description; ?></p>
        </div>

        <div>
            <div>
                <p><?= $origin; ?></p>
                <p><?= $category; ?></p>
                <p><?= $avg_rating ?></p>
            </div>
            <div>
                <p><?= $price; ?></p>
            </div>
            <div>
                <button>+ Panier</button>
                <button>Acheter</button>
            </div>
        </div>

    </main>

    <?php require_once('./includes/footer.php'); ?>

</body>
</html>