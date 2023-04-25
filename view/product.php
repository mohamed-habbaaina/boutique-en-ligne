<?php
session_start();
require_once('./../src/Classes/Product.php');
$product = new src\Classes\Product();

// Get id product or give a default id.
if (isset($_GET['idProduct'])) :
    $idProduct = $_GET['idProduct'];
else :
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
$origin_descript = $dataProduct['origin_descript'];
$category = $dataProduct['category_pro'];
$category_descript = $dataProduct['category_descript'];
$avg_rating = number_format($dataProduct['avg_rating'], 2);

// Handle cart.
$id_product = $dataProduct['id_pro'];

if (isset($_SESSION['user'])) {

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
    <link rel="stylesheet" href="./style/includes.css">
    <link rel="stylesheet" href="./style/contact.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <?php if(isset($_SESSION['user'])){ ?><script defer src="./../src/controllers/add_cart.js"></script>
        <script defer src="./js/comment.js"></script><?php }; ?>
        <script defer src="./js/rate.js"></script>
    <title>Product</title>
</head>

<body>
    <?php require_once('./includes/header.php'); ?>

    <main>

        <div class="displayCart">
            <!-- Display Js -->

        </div>

        <section class="product_info">

            <div class="product_contener">

                <div class="image_container">
                        <!-- add path image -->
                        <img src="./../uploads/<?= $image; ?>" alt="<?= $name; ?>" class="product_image">
                    
                </div>

                <div class="info_product_contener">
                    <div id="displayCart"></div>
                    <h2><?= $name; ?></h2>
                    <p><span class="titleP">Description </span>: <?= $description ?></p>
                    <p><span class="titleP"><?= $origin ?></span> : <?= $origin_descript; ?></p>
                    <p><span class="titleP"><?= $category ?></span> : <?= $category_descript; ?></p>
                    <p id="rateValue"></p>
                    <p><span class="titleP">Poids </span>: </p>
                    <p class="productPrice"><?= number_format($price / 100, 2) ?> €</p>

                    <div class="rateDisplay">
                        <p id="rateValue"></p>
                        <?php if (isset($_SESSION["user"])) : ?>
                            <form method="post" id="postRateForm">
                                <label for="rating">Sélectionnez votre note :</label>
                                <select name="rating" id="rating">
                                    <option>-- Rate --</option>
                                    <option value="1">&#9733;</option>
                                    <option value="2">&#9733; &#9733;</option>
                                    <option value="3">&#9733; &#9733; &#9733;</option>
                                    <option value="4">&#9733; &#9733; &#9733; &#9733;</option>
                                    <option value="5">&#9733; &#9733; &#9733; &#9733; &#9733;</option>
                                </select>
                            </form>

                        <?php endif ?>
                    </div>
                    <?php if (isset($_SESSION['user'])) {; ?>
                        <form action="./../src/controllers/add_cart.js" method="post" id="formCart">
                            <input type="hidden" name="id_product" value="<?= $id_product; ?>">
                            <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                            <input type="number" name="product_quantity" value="<?= 1; ?>">
                            <input type="submit" name="add_cart" value="+ Panier" />
                        </form>

                        <form action="" method="post" id="formBuy">
                            <input type="hidden" name="id_product_buy" value="<?= $id_product; ?>">
                            <input type="hidden" name="id_user_buy" value="<?= $id_user; ?>">
                            <input type="hidden" name="product_quantity_buy" value="1">
                            <input type="hidden" name="add_cart_buy" value="Acher" />
                        </form>

                        <?php if (isset($_SESSION['user'])) {; ?>
                            <button class="button-59"><a href="./cart.php">Add to cart</a></button>
                        <?php }; ?>
                    <?php }; ?>
                </div>

            </div>

            <div>
                <h2 class="description">Description:</h2>
                <p><?= $description ?></p>
            </div>
        </section>
        <section>

            <div class="commentDisplay">
                <h2 class="description">Comments</h2>
                <?php if (isset($_SESSION["user"])) : ?>
                    <form id="addCommentForm">
                        <input type="text" id="commentText" name="commentText">
                        <button id="addCommentBtn" value="<?= $id_product; ?>">Envoyer</button>
                    </form>
                <?php endif ?>
            </div>
            <section id="comment-section">

            </section>
        </section>


    </main>
    
    <?php require_once('./includes/footer.php'); ?>

</body>

</html>