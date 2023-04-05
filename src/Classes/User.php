<?php
namespace src\Classes;

require_once('DbConnection.php');

Class User
{
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = DbConnection::getDb();
    }
    
    public function create($firstname, $lastname, $email, $password)
    {
        $register = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $prepare = $this->pdo->prepare($register);
    
        $prepare->execute([
            "firstname" => $firstname, 
            "lastname" => $lastname, 
            "email" => $email,
            "password" => $password
        ]);
        
        echo "ok";
    }
}
?>