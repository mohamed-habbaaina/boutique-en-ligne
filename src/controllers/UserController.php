<?php

namespace src\controllers;
use src\Classes\User;

require_once("../Classes/User.php");


class UserController

{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register($firstname, $lastname, $email, $password, $passwordConfirm)
    {

        if (empty($firstname)) {
            echo "Firstname is empty";
        } elseif (empty($lastname)) {
            echo "Lastname is empty";
        } elseif (empty($email)) {
            echo "Email is empty";
        } elseif ($password !== $passwordConfirm) {
            echo "password and confirmation password do not match";
        } else {
            $this->user->create($firstname, $lastname, $email, $password);
        }
    }

    public function login($email, $password)
    {
        if (empty($email)) {
            echo "Email is empty";
        } elseif (empty($password)) {
            echo "Password is empty";
        } else {
            $this->user->select($email, $password);
        }
    }

    

    public function changeProfil($id, $firstname, $lastname, $email){
        $this->user->updateProfil(
            $id,
            $firstname,
            $lastname,
            $email,
        );
    }

    public function changeAddress($address, $zip, $phone){
        $this->user->updateAddress(
            $address,
            $zip,
            $phone,
        );
    }

    public function changePassword($password, $newPassword, $newPasswordConfirm){

        if($newPassword == $newPasswordConfirm){
            $this->user->updatePassword(
                $password,
                $newPassword,
            );
        }
    }
}


