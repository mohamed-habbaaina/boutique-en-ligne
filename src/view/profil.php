<?php

namespace src\Classes;

require_once('../src/Classes/User.php');
$user = new User();
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
    <link rel="stylesheet" href="./style/style.css">
    <title>Profil</title>
</head>

<body>
    <?php require_once "./includes/header.php" ?>
    <h1>Profil</h1>
    <div class="profilForm">
    <div id="contact_form">
        <h4 id="form_message"></h4>
        <div class="buttonDiv">
            <button id="nameDisplayBtn" class="button-59">Name</button>
            <button id="contactDisplayBtn" class="button-59">Adress</button>
            <button id="pwdDisplayBtn" class="button-59">Password</button>
        </div>

        <div class="profilNameDisplay" id="profilNameDisplay">
            <p id="profilMsg"></p>
            <form method="post" id="profilNameForm" class="form">
                <div id="name_form">
                    <div class="input_container" id="firstname_div">
                        <input type="text" name="profilFirstname" id="profilFirstname" value="<?= $current_profil["firstname"] ?>" placeholder=" ">
                        <label for="firstname_input">Firstname</label>
                    </div>
                    <div class="input_container" id="lastname_div">
                        <input type="text" name="profilLastname" id="profilLastname" value="<?= $current_profil["lastname"] ?>" placeholder=" ">
                        <label for="lastname_input">Lastname</label>
                    </div>
                </div>

                <div class="input_container" id="email_div">
                    <input type="text" name="profilEmail" id="profilMail" value="<?= $current_profil["email"] ?>" placeholder=" ">
                    <label for="email_input">Mail</label>
                </div>
                <div id="submit_form">
                    <button type="submit" id="nameFormBtn" class="button-59">Update</button>
                </div>
            </form>
        </div>

        <div class="profilContactDisplay" id="profilContactDisplay">
            <form method="post" id="profilContactForm" class="form">
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
                <div id="submit_form">
                    <button type="submit" id="contactFormBtn" class="button-59">Update</button>
                </div>
            </form>
        </div>
        <div class="profilPwdDisplay" id="profilPwdDisplay">
            <form method="post" id="profilPwdForm" class="form">
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
                    <button type="submit" id="pwdFormBtn" class="button-59">Update</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="./js/profil.js"></script>
</body>

</html>