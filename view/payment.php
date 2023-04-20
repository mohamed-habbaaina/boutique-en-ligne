<?php
session_start();

use src\Classes\Payment;

require_once('./../src/Classes/Payment.php');

$payment = new Payment();

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

    if(isset($_POST))
    {
        $firstname = $_SESSION['user']['firstname'];
        $lastname = $_SESSION['user']['lastname'];

        $total = $_POST['total'];

        // variable for condisional address display
        $displayAdress = false;
        
        // get adresse.
        if($payment->getAddressUser($id_user))
        {
            $address = $payment->getAddressUser($id_user);
            
            $address_cus = $address['address_cus'];
            $phone_cus = $address['phone_cus'];
            $zip_cus = $address['zip_cus'];

            // echo '<pre>';
            // var_dump($address);
            // echo '</pre>';

            if($address_cus && $zip_cus)
            {
                $displayAdress = true;

            }
        }

    
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="./../src/controllers/payment.js"></script>
    <title>Document</title>
</head>
<body>
<?php require_once('./includes/header.php'); ?>
<main>

    <div>
        <h1>Paiement :</h1>
    </div>
    <div>

        <div>
            <p>Total à Payé : <?= $total; ?></p>
        </div>

        <ul class="displayMessagePayment"></ul>
        <!-- data-set pour faire insert dans la base de données -->
        <form action="./../src/controllers/payment.js" method="post" id="formPayment">
            <div>
                <input type="text" name="firstname" value="<?= $firstname; ?>">
                <input type="text" name="lastname" value="<?= $lastname; ?>">
            </div>
            <div>
                <input type="text" name="bank_card" placeholder="Entrer Votre Carte Bancaire ...">
            </div>
            <div>
                <?php
                if($displayAdress)
                { ?>
                    <input type="number" name="phone" value="<?= $phone_cus; ?>">
                    <input type="text" name="address" value="<?= $address_cus; ?>">
                    <input type="number" name="zip" value="<?= $zip_cus; ?>">

                <?php } else
                {
                ?>
                    <input type="number" name="phone" placeholder="Entre Votre Téléphne !">
                    <input type="text" name="address" placeholder="Entre Votre Adresse !">
                    <input type="number" name="zip" placeholder="Entre Votre Code Postal !">
                <?php };?>
            </div>

            <input type="hidden" name="displayAdress" value="<?= $displayAdress; ?>">
            <input type="hidden" name="total" value="<?= $total; ?>">
            <input type="submit" value="Acheter Maintenat">

        </form>
    </div>
    <div>
        <button><a href="./cart.php">Cart</a></button>
    </div>
</main>
<?php require_once('./includes/footer.php'); ?>
</body>
</html>