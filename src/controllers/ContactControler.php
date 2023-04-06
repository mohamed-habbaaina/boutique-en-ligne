<?php

use src\Classes\Message;

class ContactControler
{
    // Le constructeur prend en paramètre un objet de type Message
    private function __construct(private Message $message)
    {
    }

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
    public function isValidForm()
    {
        return (
            $this->isValidName($this->message->getFirstname()) &&
            $this->isValidName($this->message->getLastname()) &&
            $this->isValidEmail($this->message->getEmail()) &&
            $this->isValidPhone($this->message->getPhone())
        );
    }
}
