<?php

use src\Classes\Message;

class ContactControler
{
    private function __construct(private Message $message)
    {
    }

    private function isValidName(string $name)
    {
        $nameRegex = '/^[A-Za-zéèê\- ]{2,}$/';
        return preg_match($nameRegex, $name);
    }

    private function isValidEmail($email)
    {
        $emailRegex = '/^[\w\-\.]+@([\w\-]+\.)+[\w]{2,4}$/';
        return preg_match($emailRegex, $email);
    }

    private function isValidPhone($phone)
    {
        $phoneRegex = '/^0[1-9](\d{2}){4}$/';
        return preg_match($phoneRegex, $phone);
    }

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
