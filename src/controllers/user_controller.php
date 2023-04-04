<?php
require_once("../Class/User.php");
$user = new User();

if(isset($_POST["register"])){
    
    $user->register($_POST["regFirstname"], $_POST["regLastname"], $_POST["regMail"], $_POST["regPassword"]);
}
?>