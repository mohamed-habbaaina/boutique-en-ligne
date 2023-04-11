<?php

namespace src\Classes;

session_start();

require_once('DbConnection.php');

class User
{

    private $pdo;

    public function __construct()
    {
    }

    public function create($firstname, $lastname, $email, $password)
    {
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
        $register = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $prepare = DbConnection::getDb()->prepare($register);

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

        $select = "SELECT * FROM user WHERE email=:email limit 1";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':email' => $email
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

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
            echo "Welcome";
        }
    }

    public function getData($id)
    {
        $select = "SELECT * FROM user WHERE id_user=:id";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $id
        ]);
        $user_result = $prepare->fetch(\PDO::FETCH_ASSOC);
        $select = "SELECT * FROM customer WHERE id_user=:id";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $id
        ]);
        $customer_result = $prepare->fetch(\PDO::FETCH_ASSOC);
        if ($customer_result !== false) {
            return [...$user_result, ...$customer_result];
        } else {
            return $user_result;
        }
    }

    public function updateProfil($profil)
    {
        $select = "SELECT * FROM user WHERE id_user=:id";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $profil['id_user']
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
    }

    public function updatePassword($password)
    {
        
    }
}
