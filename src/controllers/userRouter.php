<?php

namespace src\Classes;
require_once("../Classes/UserController.php");
$userController = new UserController();


if (isset($_POST["register"])) {

    $userController->register($_POST["regFirstname"], $_POST["regLastname"], $_POST["regMail"], $_POST["regPassword"], $_POST["regPasswordConfirm"]);

}
