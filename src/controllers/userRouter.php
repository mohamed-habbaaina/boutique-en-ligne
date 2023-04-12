<?php

namespace src\Classes;
require_once("../controllers/UserController.php");

$userController = new UserController();


if (isset($_POST["register"])) {

    $userController->register(
        $_POST["regFirstname"], 
        $_POST["regLastname"], 
        $_POST["regEmail"], 
        $_POST["regPassword"], 
        $_POST["regPasswordConfirm"]
    );

}

if(isset($_POST["login"])){

    $userController->login(
        $_POST["logEmail"],
        $_POST["logPassword"]
    );

}

if(isset($_POST["updateNameForm"])){

    $userController->changeProfil($_SESSION["user"]["id"], $_POST["profilFirstname"], $_POST["profilLastname"], $_POST["profilEmail"]);
}


if(isset($_POST["updateContactForm"])){
    $userController->changeAddress($_POST["profilAddress"], $_POST["profilZip"], $_POST["profilPhone"]);
}

if(isset($_POST["updatePwdForm"])){
    $userController->changePassword($_POST["profilPassword"], $_POST["newPassword"], $_POST["newPasswordConfirm"]);
}