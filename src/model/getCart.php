<?php
session_start();
require_once('./../Classes/Cart.php');

$cart = new src\Classes\Cart();
$cartExist = false;



// Secure cart:
if(!$cart->isConnected())
{
    header("location: ../../view/index.php");
    die('Acces refused to the database !!!');
} else
{
    $id_user = (int) $_SESSION['user']['id'];

    if(isset($_SESSION['id_cart']))
    {
        $id_cart = (int) $_SESSION['id_cart'];
        // Get cart
        if($cart->getAllCart($id_cart))
        {
        
            $data = $cart->getAllCart($id_cart);
            $cartExist = true;
        }
    }
    else echo json_encode('empty id_cart');
}

if($cartExist)
{
    echo json_encode($data);

}