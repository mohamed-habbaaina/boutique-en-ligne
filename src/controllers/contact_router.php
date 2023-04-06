<?php

namespace src\Classes;

// Inclure les fichiers nécessaires pour utiliser les classes Message, ContactControler et ContactModel
require_once("../Classes/Message.php");
require_once("./ContactControler.php");
require_once("../model/ContactModel.php");

// Vérifier si les champs du formulaire de contact ont été soumis
if (isset($_POST["contact_content"]) && isset($_POST["contact_firstname"]) && isset($_POST["contact_lastname"]) && isset($_POST["contact_email"])) {
    // Récupérer les valeurs des champs du formulaire et les nettoyer avec la fonction htmlspecialchars pour éviter les attaques XSS
    $content = htmlspecialchars($_POST['contact_content']);
    $firstname = htmlspecialchars($_POST['contact_firstname']);
    $lastname = htmlspecialchars($_POST['contact_lastname']);
    $email = htmlspecialchars($_POST['contact_email']);
    $phone = htmlspecialchars($_POST['contact_phone']);

    // Créer un nouvel objet Message avec les données du formulaire
    $message = new Message($content, $firstname, $lastname, $email, $phone);
    
    // Créer un nouvel objet ContactControler pour valider les données du formulaire
    $contactControler = new ContactControler();
    
    // Créer un nouvel objet ContactModel pour enregistrer le message dans la base de données
    $contactModel = new ContactModel();

    // Vérifier si les données du formulaire sont valides
    if ($contactControler->isValidForm($message))
    {
       // Si les données sont valides, enregistrer le message dans la base de données
       $contactModel->register($message);
    }    
}