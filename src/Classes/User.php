<?php

require_once('DbConnection.php');

Class User
{
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = DbConnection::getDb();
        var_dump($this->pdo);
    }
    public function register($firstname, $lastname, $mail, $password)
    {
        $register = "INSERT INTO user (firstname = :firstname , lastname = :lastname, email = :email, password = :password)";
        $prepare = $this->pdo->prepare($register);
        $prepare->execute([
          "firstname" => $firstname, 
          "lastname"=> $lastname, 
          "mail" => $mail,
          "password" => $password,]);
        
        echo "ok";
    }
}
?>