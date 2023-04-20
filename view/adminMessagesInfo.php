<?php

use src\controllers\AdminController;

require_once('../src/controllers/AdminController.php');

if (isset($_GET["messageId"])) {
    $messageId = $_GET['messageId'];
    $adminController = new AdminController();
    $data = $adminController->getMessage($messageId);
    $firstname = $data['firstname_mes'];
    $lastname = $data['lastname_mes'];
    $email = $data['email_mes'];
    $tel = $data['tel_mes'];
    $date = $data['date_mes'];
    $content = $data['content_mes'];
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message <?= $_GET['id_mes']; ?></title>
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="./js/adminProductInfo.js" defer></script>
</head>

<body>

    <?php require_once("./includes/header.php"); ?>
    <main>

        <h3>Message <?= $messageId ?></h3>

        <p>
            <?= $firstname . ' ' . $lastname ?><br>
            <?= $email ?><br>
            <?= $tel ?><br>
            <?= $date ?>
        </p>

        <p>
            <?= $content ?>
        </p>

    </main>
</body>