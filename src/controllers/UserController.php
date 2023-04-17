<?php

namespace src\controllers;

use Exception;
use src\Classes\User;
use src\Classes\Product;

require_once("../Classes/User.php");
require_once("../Classes/Product.php");
require_once("./FormControler.php");

class UserController extends FormControler

{
    public $user;
    public $product;

    public function __construct()
    {
        $this->user = new User();
        $this->product = new Product();
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


    public function changeProfil($id, $firstname, $lastname, $email)
    {
        $this->user->updateProfil(
            [
                "id_user" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email
            ]
        );
    }

    public function changeAddress($id, $address, $zip)
    {
        if (strlen($address) > 10 && strlen($zip > 3)) {
            $this->user->updateAddress(
                [
                    "id_user" => $id,
                    "address" => $address,
                    "postal_code" => $zip
                ]
            );
        } else {
            throw new Exception("Paramètres invalides");
        }
    }

    public function changePhone($phone,$id) {
        if ($this->isValidPhone($phone)) {
            $this->user->updatePhone($phone, $id);
        }
    }

    public function changePassword($id, $password, $newPassword, $newPasswordConfirm)
    {
        $profil = $this->user->getData($id);

        if (password_verify($password, $profil["password"])) {

            if ($newPassword == $newPasswordConfirm) {

                $this->user->updatePassword($id, $newPassword);
            } else {
                echo "New password and new password confirm not match";
            }
        } else {
            echo "Invalid password";
        }
    }

    public function getUserData()
    {
        $this->user->getAllUserData();
    }
}
