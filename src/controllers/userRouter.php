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

if(isset($_POST["update"])){
    $userController->update(
        $_SESSION["user"]["id"],
        $_POST["profilFirstname"], 
        $_POST["profilLastname"], 
        $_POST["profilEmail"], 
        $_POST["profilAddress"], 
        $_POST["profilZip"], 
        $_POST["profilPhone"], 
        $_POST["profilPassword"], 
        $_POST["profilPasswordConfirm"] 
    );
}

