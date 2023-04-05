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

    public function select($email, $password)
    {

            $select = $this->pdo->prepare("SELECT * FROM user WHERE email=$email limit 1");
            $select->execute();
            $result = $select->fetchAll($this->pdo::FETCH_ASSOC);
            
            if (count($result) == 0) {
                echo "Incorrect email or password.";
            } elseif ($result["password"] !== $password) {
                echo "Incorrect email or password.";
            } elseif ($result["password"] == $password) {
                $_SESSION["userId"] = $result["id"];
                $_SESSION["userLogin"] = $result["login"];
                $_SESSION["role"] = $result["role"];
    
                echo "Welcome" . $_SESSION["userLogin"];
    
            }
        }
    
}
?>