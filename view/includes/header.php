<?php
session_start();

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
            <li><button id="logDisplayBtn">Login</button></li>
            <li><button id="regDisplayBtn">Register</button></li>
            <?php if(isset($_SESSION["id_user"])) : ?>
                <li><button>Deconnexion</button></li>
            <?php endif ?>
        </ul>
    </div>
</nav>