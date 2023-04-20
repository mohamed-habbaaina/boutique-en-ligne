<?php
session_start();

use src\Classes\Payment;

require_once('./../Classes/Payment.php');

$payment = new Payment();

$valid = false;
$messag = [];

// ?Secure payment page: isConnected && checkSecureCart.
if(!$payment->isConnected())
{
    header('Location: index.php');
    die('Acces refused to the database !!!');
} else
{
    $id_user = (int) $_SESSION['user']['id'];
    $id_cart = (int) $_SESSION['id_cart'];
}

// Check if id_user corresponding to id_cart.
if(!$payment->checkSecureCart($id_cart, $id_user))
{
    header("location: ../../view/index.php");
    die('Acces refused to the database !!!');
} else
{

    if($_POST['total'])
    {

        $postTotal = $_POST['total'];
        $total = 100 * $postTotal;
    
        
        $displayAdress = $_POST['displayAdress'];
        
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $zip = $_POST['zip'];
        $bank_card = $_POST['bank_card'];

        // Check if user has filled in the delivery information 
        if(empty($_POST['address']) || empty($_POST['zip']))
        {
            $messag[] = '<li>Veillez renseigné votre adresse de livraison !</li>';
        }
        if(empty($_POST['bank_card']))
        {
            $messag[] = '<li>Veillez renseigné votre Carte bancaire !</li>';
        }

        // stored user delivery data
        if(!$displayAdress){
            
            $payment->insertAddress($id_user, $address, $zip, $phone);
        }
        

        if(!empty($messag))
        {
            echo json_encode($messag);
        } else
        {
            // payment
            $payment->payment($id_user, $id_cart, $total);
            
            // Set state cart => closed.
            $payment->setStateCart($id_cart);

            // session id_cart 
            unset($_SESSION['id_cart']);
            
            $valid = true;
        
            echo json_encode($valid);
        }
    }
    
}