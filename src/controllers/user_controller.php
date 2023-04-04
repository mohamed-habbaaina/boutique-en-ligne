<?php
require_once("../Class/User.php");
$user = new User();

if (isset($_POST["register"])) {
    
    if (empty($_POST["regFirstname"])){
        echo "Firstname is empty";
    }

    elseif (empty($_POST["regLastname"])){
        echo "Lastname is empty";
    }
    elseif(empty($_POST["regMail"])){
        echo "Mail is empty";
    }
   
    elseif ($_POST["regPassword"] !== $_POST["regPasswordConfirm"]){
        echo "password and confirmation password do not match";
    } 
    else {
        $user->register($_POST["regFirstname"], $_POST["regLastname"], $_POST["regMail"], $_POST["regPassword"]);
    }
}
