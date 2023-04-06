<?php

use src\Classes\Message;

class ContactControler
{
    // Fonction privée pour vérifier si un nom est valide (au moins 2 caractères et uniquement des lettres, des espaces, des tirets et des accents)
    private function isValidName(string $name)
    {
        $nameRegex = '/^[A-Za-zéèê\- ]{2,}$/';
        return preg_match($nameRegex, $name);
    }

    // Fonction privée pour vérifier si un email est valide
    private function isValidEmail($email)
    {
        $emailRegex = '/^[\w\-\.]+@([\w\-]+\.)+[\w]{2,4}$/';
        return preg_match($emailRegex, $email);
    }

    // Fonction privée pour vérifier si un numéro de téléphone est valide (format français)
    private function isValidPhone($phone)
    {
        $phoneRegex = '/^0[1-9](\d{2}){4}$/';
        return preg_match($phoneRegex, $phone);
    }

    // Fonction publique pour vérifier si le formulaire est valide (tous les champs sont valides)
    public function isValidForm(Message $message)
    {
        return (
            $this->isValidName($message->getFirstname()) &&
            $this->isValidName($message->getLastname()) &&
            $this->isValidEmail($message->getEmail()) &&
            $this->isValidPhone($message->getPhone())
        );
    }
}
