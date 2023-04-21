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
if($_GET['idProduct'])
{
    // var_dump($_GET['idProduct']);
    $id_product = (int) $_GET['idProduct'];
    $cart->deletCartProduct($id_cart, $id_product);
    header("location: ../../view/cart.php");

}