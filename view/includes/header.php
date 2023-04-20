<?php
if (isset($_SESSION["user"])) {
    if (isset($_POST["deco"])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>
<nav>
    <div class="left_part">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="shop.php">Shop</a>
        <?php if (isset($_SESSION["user"])) : ?>
            <a href="cart.php">Cart</a>
            <?php endif ?>
    </div>
    <div class="logo_part">
        <img src="./img/logo1.png">
    </div>
    <div class="right_part">
        
        <a href="contact.php">Contact</a>
       
        <div id="menu">
            <ul>
                <li>
                    <a href="#">Account</a>
                    <ul>
                        <?php if (isset($_SESSION["user"])) : ?>
                            <li><a href="profil.php">Profil</a></li>
                            <form method="post">
                                <li><button name="deco" id="decoBtn">Deconnexion</button></li>
                            </form>
                        <?php else : ?>
                            <li><button id="logDisplayBtn">Login</button></li>
                            <li><button id="regDisplayBtn">Register</button></li>
                        <?php endif ?>
                    </ul>
                </li>
            </ul>
            
        </div>
        <div id="search">

    <form action="./../src/controllers/searchProduct.js" method="get" id="searchForm">
        <input type="search" name="search" placeholder="Search">
    </form>
    <div id="displayResult"></div>
    </div>
</nav>
<script defer src="./../src/controllers/searchProduct.js" defer></script>
<script src="./js/auth.js" defer></script>