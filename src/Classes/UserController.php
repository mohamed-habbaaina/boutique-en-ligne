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
            echo "Email is empty";
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
        if(empty($email)){
            echo "Email is empty" ;
        }
        elseif(empty($password)){
            echo "Password is empty";
        }
        else{
        $this->user->select($email, $password);
        }
    }
}
?>