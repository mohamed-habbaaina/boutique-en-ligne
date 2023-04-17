<?php
session_start();
require_once('./../Classes/Cart.php');

$cart = new src\Classes\Cart();
$cartExist = false;


$id_user = (int) $_SESSION['user']['id'];
$id_cart = (int) $_SESSION['id_cart'];

// ?Secure cart:
// Check if id_user corresponding to id_cart.
if(!$cart->checkSecureCart($id_cart, $id_user))
{
    header("location: ../../view/index.php");
    die('Acces refused to the database !!!');
} else
{
    // Get cart
    if($cart->getAllCart($id_cart))
    {
    
        $data = $cart->getAllCart($id_cart);
        $cartExist = true;
    }
}

if($cartExist)
{

    echo json_encode($data);
}