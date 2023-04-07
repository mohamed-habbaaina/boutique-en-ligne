<?php

namespace src\Classes;

class ContactControler
{
    // Fonction privée pour vérifier si un nom est valide (au moins 2 caractères et uniquement des lettres, des espaces, des tirets et des accents)
    private function isValidName(string $name)
    {
        $nameRegex = '/^[A-Za-zéèê\- ]{2,}$/';
        return preg_match($nameRegex, $name);
    }

    // Fonction privée pour vérifier si un email est valide
    private function isValidEmail(string $email)
    {
        $emailRegex = '/^[\w\-\.]+@([\w\-]+\.)+[\w]{2,4}$/';
        return preg_match($emailRegex, $email);
    }

    // Fonction privée pour vérifier si un numéro de téléphone est valide (format français)
    private function isValidPhone(string $phone)
    {
        $phoneRegex = '/^0[1-9](\d{2}){4}$/';
        return preg_match($phoneRegex, $phone);
    }

    // Fonction privée pour vérifier si le formulaire est valide (tous les champs sont valides)
    private function isValidForm(Message $message)
    {
        return (
            $this->isValidName($message->getFirstname()) &&
            $this->isValidName($message->getLastname()) &&
            $this->isValidEmail($message->getEmail()) &&
            $this->isValidPhone($message->getPhone())
        );
    }

    public function sendMessage(Message $message)
    {
        if ($this->isValidForm($message)) {
            $contactModel = new ContactModel();
            $contactModel->register($message);
        }
    }
    
}
