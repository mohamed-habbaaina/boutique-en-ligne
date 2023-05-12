<?php
session_start()
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/contact.css">
</head>

<body>

    <?php require_once("./includes/header.php"); ?>

    <main>
        <section id="about_section">
            <h2>ABOUT US</h2>
            <div id="about_text">
                <p>Welcome to our E-shop website !</p>

                <p>We are Alban MARTINANT DE PRENEUF, Guangquan YE and Mohamed HABBAAINA,
                    we have created this platform for our school project, using PHP, JavaScript without any frameworks.</p>
                <p>We are trying to provide a user-friendly and efficient platform for online shopping. We understand the importance of convenience and accessibility, and have therefore designed our website to cater to the needs of customers.
                </p>
                <p>We appreciate your feedback and suggestions, and welcome you to explore our website and experience our commitment.</p>
            </div>
        </section>
    </main>

    <?php require_once("./includes/footer.php"); ?>
    <script src="./js/auth.js"></script>
    </script>

</body>

</html>