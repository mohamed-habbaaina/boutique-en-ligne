<?php
session_start();
// Create or increment the navigation page number
// get the page number and store it in a global session variable
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = ($page < 1) ? 1 : $page;
$_SESSION['page'] = $page;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/shop.css">

    <link rel="stylesheet" href="./style/includes.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <script defer src="./../src/controllers/shop.js"></script>
    <title>Shop</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>
        <div class="container">

            <div class="page">
                <button class="btn btn_suivant"><a href="shop.php?page=<?php echo $page +1 ?>" >Next Page >></a></button>
                <button class="btn"><a href="shop.php?page=<?php echo $page -1 ?>"> << Previous Page</a></button>
            </div>
            <div class="filter">
                <form id="selectCategory">
                <div id="categoryDiv">
                    <h4>Per category</h4>

                </div>
                </form>
                <form id="selectOrigin">
                    <div id="originDiv">
                        <h4>Per origin</h4>
                    </div>
                </form>
            </div>
            <div class="shop" id="shop">
                <!-- Display products whith api fetch -->
            </div>

        </div>

        <div class="page">
            <button class="btn btn_suivant"><a href="shop.php?page=<?php echo $page +1 ?>">Next Page >></a></button>
            <button class="btn"><a href="shop.php?page=<?php echo $page -1 ?>"> << Previous Page</a></button>
        </div>

    </main>

    <?php require_once('./includes/footer.php'); ?>
    <script src="./js/filter.js"></script>
</body>
</html>