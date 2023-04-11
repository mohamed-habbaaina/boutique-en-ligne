<?php
namespace src\Classes;
require_once('../src/Classes/User.php');
$user = new User();
var_dump($user->getData($_SESSION['user']['id']));
$current_profil = $user->getData($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/contact.css">
    <link rel="stylesheet" href="./style/includes.css">
    <title>Profil</title>
</head>
<body>
    <?php require_once "./includes/header.php" ?>
    <div id="contact_form">
        <h3>Profil</h3>
        <h4 id="form_message"></h4>
        <form method="post" id="updateForm">
            <div id="name_form">
                <div class="input_container">
                    <input type="text" name="profilFirstname" id="profilFirstname" value="<?= $current_profil["firstname"] ?>"  placeholder=" ">
                    <label for="profilFirstname">Firstname</label>
                </div>
                <div class="input_container">
                    <input type="text" name="profilLastname" id="profilLastname" value="<?= $current_profil["lastname"] ?>" placeholder=" ">
                    <label for="profilLastname">Lastname</label>
                </div>
            </div>
            <div class="input_container">
                <input type="text" name="profilEmail" id="profilMail" value="<?= $current_profil["email"] ?>" placeholder=" ">
                <label for="profilEmail">Mail</label>
            </div>
            <div class="input_container">
                <input type="text" name="profilAddress" id="profilAddress" value="<?= isset($current_profil["address_cus"]) ? $current_profil["address_cus"] : null ?>" placeholder=" ">
                <label for="profilAddress">Address</label>
            </div>
            <div class="input_container">
                <input type="text" name="profilZip" id="profilZip" value="<?= isset($current_profil["zip_cus"]) ? $current_profil["zip_cus"] : null ?>" placeholder=" ">
                <label for="profilZip">Zip</label>
            </div>
            <div class="input_container">
                <input type="text" name="profilPhone" id="profilPhone" value="<?= isset($current_profil["phone_cus"]) ? $current_profil["phone_cus"] : null ?>" placeholder=" ">
                <label for="profilPhone">Phone</label>
            </div>
            <div class="input_container">
                <input type="password" name="profilPassword" id="profilPassword" placeholder=" ">
                <label for="profilPassword">Old Password</label>
            </div>
            <div class="input_container">
                <input type="password" name="newPassword" id="newPassword" placeholder=" ">
                <label for="newPassword">New Password</label>
            </div>
            <div class="input_container">
                <input type="password" name="newPasswordConfirm" id="newPasswordConfirm" placeholder=" ">
                <label for="newPasswordConfirm">Confirm New Password</label>
            </div>

            <div id="submit_form">
                <button type="submit" id="profilBtn">Update</button>
            </div>
        </form>
    </div>
    <script src="./js/profil.js"></script>
</body>
</html>