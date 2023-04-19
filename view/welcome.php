<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <main>
        <div>
            <?php
            if(isset($_SESSION)){
            $login = $_SESSION['user']['firstname'];
            sleep(2000);
            echo 'Bienvenue ' . $login;
            header('Location: shop.php');
            }
            ?>

        </div>
    </main>
</body>
</html>