<?php
session_start();
require_once('./../Classes/Cart.php');

$cart = new src\Classes\Cart();

$id_user = (int) $_SESSION['user']['id'];
$id_cart = (int) $_SESSION['id_cart'];

// Check if id_user corresponding to id_cart.
if(!$cart->checkSecureCart($id_cart, $id_user))
{
    header("location: ../../view/");
    die('Acces refused to the database !!!');
}

if($_POST['id_user'] && $_POST['id_user'] == $id_user)
{
    $id_product = (int) $_POST['id_product'];
    $product_quantity = (int) $_POST['product_quantity'];

    $dataCart = $cart->selectProductCartQantity($id_cart, $id_product);

    // $


}