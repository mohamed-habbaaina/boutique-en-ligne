<?php
session_start();
require_once('./../src/Classes/Product.php');
$product = new src\Classes\Product();

// Get id product or give a default id.
if(isset($_GET['idProduct'])):
    $idProduct = $_GET['idProduct'];
else:
    // Default id === last id.
    $idProduct = $product->getLastId()[0];
endif;

$dataProduct =  $product->getProduct($idProduct);
// var_dump($dataProduct);
// echo '<br>';
// echo '<br>';
// echo '<br>';
// var_dump($_SESSION);

// get data product where id & customer rating
$name = $dataProduct['name_pro'];
$description = $dataProduct['description_pro'];
$price = $dataProduct['price_pro'];
$image = $dataProduct['image_pro'];
$origin = $dataProduct['origin_pro'];
$category = $dataProduct['category_pro'];
$avg_rating = number_format($dataProduct['avg_rating'],2);

// Handle cart.
$id_product = $dataProduct['id_pro'];

if(isset($_SESSION['user'])){

    $id_user = $_SESSION['user']['id'];
}

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
    <script defer src="./../src/controllers/add_cart.js"></script>
    <title>Product</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>

        <div>
            <div class="displayCart">
                <!-- tomporaire por le css-->
                <!-- Vous avez maitenant 4 produit dans le panier ! -->

            </div>
            <div>
                <h1><?= $name; ?></h1>
                <!-- add path image -->
                <img src="./../uploads/<?= $image; ?>" alt="<?= $name; ?>">
            </div>
            
            <div>
                <div id="displayCart"></div>
                <h3><?= $name; ?></h3>
                <p>Poids</p>
                <p><?= $origin; ?></p>
                <p><?= $category; ?></p>
                <p><?= $avg_rating ?>/5 *</p>
                <p><?= $price; ?></p>

                <?php if(isset($_SESSION['user'])){;?>
                <form action="./../src/controllers/add_cart.js" method="post" id="formCart">
                    <input type="hidden" name="id_product" value="<?= $id_product;?>">
                    <input type="hidden" name="id_user" value="<?= $id_user;?>">
                    <input type="number" name="product_quantity" value="<?= 1;?>">
                    <input type="submit" name="add_cart" value="+ Panier"/>
                </form>

                <form action="" method="post" id="formBuy">
                    <input type="hidden" name="id_product_buy" value="<?= $id_product;?>">
                    <input type="hidden" name="id_user_buy" value="<?= $id_user;?>">
                    <input type="hidden" name="product_quantity_buy" value="1">
                    <input type="submit" name="add_cart_buy" value="Acher"/>
                </form>
                <?php };?>

            </div>
        </div>
        
        <div>
            <h2>Description:</h2>
            <p><?= $description; ?></p>
        </div>

    </main>

    <?php require_once('./includes/footer.php'); ?>

</body>
</html>