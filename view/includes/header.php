<?php
session_start();
if(isset($_SESSION["user"])){
    if(isset($_POST["deco"])){
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>
<nav>
    <div class="left_part">
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
    </div>
    <div class="logo_part">
        <img src ="./view/img/logo.png">
    </div>
    <div class="right_part">
        <a href="about.php">About Us</a>
        <ul>
            <?php if(isset($_SESSION["user"])) : ?>
                <li><a href="profil.php">Profil</a></li>
                <form method="post">
                <li><button name="deco">Deconnexion</button></li>
                </form>
            <?php else : ?>
                <li><button id="logDisplayBtn">Login</button></li>
                <li><button id="regDisplayBtn">Register</button></li>
            <?php endif ?>
        </ul>
    </div>
</nav>