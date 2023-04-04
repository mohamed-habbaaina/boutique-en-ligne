<?php

var_dump($_POST);

if (isset($_POST["content"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])) {
    $content = $_POST['content'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $post['phone'];
    
    
    
    $message = new Message($content, $firstname, $lastname, $email, $tel);
    $message->register();
}
