<?php

namespace src\controllers;
use src\Classes\Message;
use src\model\ContactModel;

require_once('./FormControler.php');
require_once('../Classes/Message.php');
require_once('../model/ContactModel.php');

class ContactControler extends FormControler
{
    // Fonction privée pour vérifier si le formulaire est valide (tous les champs sont valides)
    protected function isValidForm(Message $message = null)
    {
        return (
            $this->isValidName($message->getFirstname()) &&
            $this->isValidName($message->getLastname()) &&
            $this->isValidEmail($message->getEmail()) &&
            $this->isValidPhone($message->getPhone())
        );
    }

    public function sendMessage(Message $message = null)
    {
        if ($this->isValidForm($message)) {
            $contactModel = new ContactModel();
            $contactModel->register($message);
        }
    }
    
}