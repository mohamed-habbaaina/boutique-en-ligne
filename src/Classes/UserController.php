<?php
namespace src\Classes;

require_once("../Classes/User.php");


Class UserController

{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }
   
    public function register($firstname, $lastname, $email, $password, $passwordConfirm){

        if (empty($firstname)){
            echo "Firstname is empty";
        }
        elseif (empty($lastname)){
            echo "Lastname is empty";
        }
        elseif(empty($email)){
            echo "Mail is empty";
        }
        elseif ($password !== $passwordConfirm){
            echo "password and confirmation password do not match";
        } 
        else {
            $this->user->create($firstname, $lastname, $email, $password);
        }


    }

    public function login($email, $password)
    {

        $this->user->select($email, $password);
    }
}
?>