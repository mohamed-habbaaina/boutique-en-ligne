<?php

function isValidName($name) {
    $nameRegex = '/^[A-Za-zéèê\- ]{2,}$/';
    return preg_match($nameRegex, $name);
}

if (isset($_POST["contact_content"]) && isset($_POST["contact_firstname"]) && isset($_POST["contact_lastname"]) && isset($_POST["contact_email"])) {
    $content = htmlspecialchars($_POST['contact_content']);
    $firstname = htmlspecialchars($_POST['contact_firstname']);
    $lastname = htmlspecialchars($_POST['contact_lastname']);
    $email = htmlspecialchars($_POST['contact_email']);
    $tel = htmlspecialchars($post['contact_phone']);

    $isValidForm = true;
    
    if (!isValidName($firstName) || !isValidName($lastName)) {
        $isValidForm = false;
    }
    
    if ($isValidForm) 
    {
        $message = new ContactModel($content, $firstname, $lastname, $email, $tel);
        $message->register();
    }
}