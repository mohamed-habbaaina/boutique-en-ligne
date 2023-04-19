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
    <script defer src="./../src/controllers/shop.js"></script>
    <title>Shop</title>
</head>
<body>
    <?php require_once('./includes/header.php'); ?>

    <main>
        <div class="container">

            <div class="page">
                <button><a href="shop.php?page=<?php echo $page -1 ?>">Previous Page <<</a></button>
                <button><a href="shop.php?page=<?php echo $page +1 ?>" id="btn_suivant">Next Page >></a></button>
            </div>

            <div class="shop">
                <!-- Display products whith api fetch -->
            </div>

        </div>
    </main>

    <?php require_once('./includes/footer.php'); ?>
</body>
</html>