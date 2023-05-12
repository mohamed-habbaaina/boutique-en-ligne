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
    <div class="top_part">
        <div class="logo_part">
            <img src="./public/img/logo1.png">
        </div>
            <div id="menu">
                <ul>
                    <li>
                        <a href="#"><ion-icon name="person-circle-outline"></ion-icon></a>
                        <ul>
                            <?php if (isset($_SESSION["user"])) : ?>
                                <?php if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') : ?>
                                    <li><a href="profil.php">Profil</a></li>
                                <?php else : ?>
                                    <li><a href="admin.php">Admin</a></li>
                                <?php endif ?>
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
        
    </div>

    <div class="bottom_part">
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <?php if (isset($_SESSION["user"])) : ?>
            <a href="cart.php">Cart</a>
        <?php endif ?>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <div id="search">

            <form action="./../src/controllers/searchProduct.js" method="get" id="searchForm">
                <input type="search" name="search" placeholder="Search">
            </form>
            <div id="displayResult"></div>
        </div>
    </div>
    


</nav>
<div class="navbar">
    <div class="container nav-container">
        <input class="checkbox" type="checkbox" name="" id="" />
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <div class="menu-items">
            <li><a href="../view/index.php">Home</a></li>
            <li><a href="../view/about.php">About</a></li>
            <li><a href="../view/shop.php">Shop</a></li>
            <li><a href="../view/cart.php">Cart</a></li>
            <li><a href="../view/contact.php">Contact</a></li>
        </div>
    </div>
</div>

<script defer src="./../src/controllers/searchProduct.js" defer></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

