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
        <a href="shop.php">Shop</a>
        <?php if (isset($_SESSION["user"])) : ?>
            <a href="cart.php">Cart</a>
        <?php endif ?>
    </div>
    <div class="logo_part">
        <img src="./img/logo1.png">
    </div>
    <div class="right_part">
        <div id="menu">
            <ul>
                <li>
                    <a href="#">Account</a>
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
        <div id="search">

            <form action="./../src/controllers/searchProduct.js" method="get" id="searchForm">
                <input type="search" name="search" placeholder="Search">
            </form>
            <div id="displayResult"></div>
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
            <li><a href="#">Home</a></li>
            <li><a href="#">about</a></li>
            <li><a href="#">blogs</a></li>
            <li><a href="#">portfolio</a></li>
            <li><a href="#">contact</a></li>
        </div>
    </div>
</div>

<script defer src="./../src/controllers/searchProduct.js" defer></script>

<?php if (!isset($_SESSION['user'])) : ?>
    <script src="./js/auth.js" defer></script>
<?php endif ?>