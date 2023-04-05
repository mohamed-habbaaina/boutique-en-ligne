<?php
namespace src\Classes;
session_start();

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
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
        $register = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $prepare = $this->pdo->prepare($register);
    
        $prepare->execute([
            "firstname" => $firstname, 
            "lastname" => $lastname, 
            "email" => $email,
            "password" => $hashed_pwd,
        ]);
        
        echo "ok";
    }

    public function select($email, $password)
    {

            $select = $this->pdo->prepare("SELECT * FROM user WHERE email=:email limit 1");
            $select->execute([
                ':email' => $email
            ]);
            $result = $select->fetch($this->pdo::FETCH_ASSOC);
            
            if (count($result) == 0) {
                echo "Incorrect email or password.";
                die();
            } elseif (!password_verify($password, $result["password"])) {
                echo "Incorrect email or password.";
                die();
            } else {
                $_SESSION["user"] = [
                    "id" => $result["id_user"],
                    "firstname" => $result["firstname"],
                    "lastname" => $result["lastname"],
                    "email" => $result["email"],
                ];
                
                var_dump($_SESSION["user"]);
    
            }
        }
    
}
?>