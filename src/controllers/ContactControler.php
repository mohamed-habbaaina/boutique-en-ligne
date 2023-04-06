<?php

class ContactControler
{

    public function isValidName(string $name)
    {
        $nameRegex = '/^[A-Za-zéèê\- ]{2,}$/';
        return preg_match($nameRegex, $name);
    }

    public function isValidEmail($email)
    {
        $emailRegex = '/^[\w\-\.]+@([\w\-]+\.)+[\w]{2,4}$/';
        return preg_match($emailRegex, $email);
    }

    public function isValidPhone($phone)
    {
        $phoneRegex = '/^0[1-9](\d{2}){4}$/';
        return preg_match($phoneRegex, $phone);
    }
}
