<?php

namespace src\controllers;

require_once("./UserController.php");


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
    $userController->changeAddress($_SESSION["user"]["id"], $_POST["profilAddress"], $_POST["profilZip"], $_POST["profilPhone"]);
}

if(isset($_POST["updatePwdForm"])){
    $userController->changePassword($_SESSION["user"]["id"], $_POST["profilPassword"], $_POST["newPassword"], $_POST["newPasswordConfirm"]);
}

if(isset($_GET["fetch"])){
    $fetch = $_GET["fetch"];
    if ($fetch === "user") {
        $userController->getUserData();
    }
}

if(isset($_POST['firstname'])) {
    var_dump($_POST);
    $userController->changeFirstname($_POST['id'], $_POST['firstname']);
}

if(isset($_POST['lastname'])) {
    var_dump($_POST);
    $userController->changeLastname($_POST['id'], $_POST['lastname']);
}

if(isset($_POST['email'])) {
    var_dump($_POST);
    $userController->changeEmail($_POST['id'], $_POST['email']);
}

if(isset($_POST['password'])) {
    var_dump($_POST);
    $userController->AdminChangePassword($_POST['id'], $_POST['password']);
}

if(isset($_POST['address']) && isset($_POST['zip'])) {
    var_dump($_POST);
    $userController->changeAddress($_POST['id'], $_POST['address'], $_POST['zip']);
}

if(isset($_POST['phone'])) {
    var_dump($_POST);
    $userController->changePhone($_POST['phone'], $_POST['id']);
}

