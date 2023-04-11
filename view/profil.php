<?php
session_start();
var_dump($_SESSION["user"]);
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
                    <input type="text" name="profilFirstname" id="profilFirstname" placeholder=" ">
                    <label for="profilFirstname">Firstname</label>
                </div>
                <div class="input_container">
                    <input type="text" name="profilLastname" id="profilLastname" placeholder=" ">
                    <label for="profilLastname">Lastname</label>
                </div>
            </div>
            <div class="input_container">
                <input type="text" name="profilMail" id="profilMail" placeholder=" ">
                <label for="profilEmail">Mail</label>
            </div>
            <div class="input_container">
                <input type="text" name="profilAddress" id="profilAddress" placeholder=" ">
                <label for="profilAddress">Address</label>
            </div>
            <div class="input_container">
                <input type="text" name="profilZip" id="profilZip" placeholder=" ">
                <label for="profilZip">Zip</label>
            </div>
            <div class="input_container">
                <input type="text" name="profilPhone" id="profilPhone" placeholder=" ">
                <label for="profilPhone">Phone</label>
            </div>
            <div class="input_container">
                <input type="password" name="profilPassword" id="profilPassword" placeholder=" ">
                <label for="profilPassword">Password</label>
            </div>
            <div class="input_container">
                <input type="password" name="profilPasswordConfirm" id="profilPasswordConfirm" placeholder=" ">
                <label for="profilPasswordConfirm">Confirm</label>
            </div>

            <div id="submit_form">
                <button type="submit" id="profilBtn">Update</button>
            </div>
        </form>
    </div>
    <script src="./js/profil.js"></script>
</body>
</html>