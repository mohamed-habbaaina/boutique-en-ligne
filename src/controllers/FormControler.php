<?php

namespace src\controllers;

abstract class FormControler
{
     // Fonction pour vérifier si un nom est valide (au moins 2 caractères et uniquement des lettres, des espaces, des tirets et des accents)
    protected function isValidName(string $name)
    {
        $nameRegex = '/^[A-Za-zéèê\- ]{2,}$/';
        return preg_match($nameRegex, $name);
    }

    // Fonction pour vérifier si un email est valide
    protected function isValidEmail(string $email)
    {
        $emailRegex = '/^[\w\-\.]+@([\w\-]+\.)+[\w]{2,4}$/';
        return preg_match($emailRegex, $email);
    }

    // Fonction pour vérifier si un numéro de téléphone est valide (format français)
    protected function isValidPhone(string $phone)
    {
        $phoneRegex = '/^0[1-9](\d{2}){4}$/';
        return preg_match($phoneRegex, $phone);
    }

    // abstract protected function isValidForm();
    // abstract protected function sendMessage();
}