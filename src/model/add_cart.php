<?php
session_start();
use src\Classes\Cart;

require_once('./../Classes/Cart.php');

$cart = new Cart();
$id_user = (int) $_SESSION['user']['id'];

$message = [];

if($_POST['id_user'] && $_POST['id_user'] == $id_user)
{
    // $id_user = $_POST['id_user'];
    $id_product = (int) $_POST['id_product'];
    $product_quantity = (int) $_POST['product_quantity'];


    if(!isset($_SESSION['id_cart']))
    {
        // check if a user's cart is open 'en cours'.
        $selectIdCart = $cart->selectIdCart($id_user);


        if(!$selectIdCart)
        {
            // insert new cart.
            $cart->insertCart($id_user);
            $selectIdCart = $cart->selectIdCart($id_user);
            $id_cart = (int) $selectIdCart;
        } else{
            // get and store 'id_cart' in a session variable $_SESSION['id_cart']
            $id_cart = $selectIdCart;
            $_SESSION['id_cart'] = $id_cart;
        }

    } else{
        
        $id_cart = $_SESSION['id_cart'];
    }

    // check if the product already exists in the database and check the quantity too.
    $dataCart = $cart->selectProductCartQantity($id_cart, $id_product);

    if(!empty($dataCart))
    {
        $quantityDB = (int) $dataCart['quantity'];
        $newQantity = $product_quantity + $quantityDB;

        // Update quantity in cart_product.
        $cart->updatProductCart($newQantity, $id_cart, $id_product);

        $message[] = "You have $newQantity products in the cart !";

    } else
    {
        // Create cart_product.
        $cart->insertProductCart($id_cart, $id_product, $product_quantity);

        $message[] = "You have added $product_quantity products to the cart !";
    }

    echo json_encode($message);
}