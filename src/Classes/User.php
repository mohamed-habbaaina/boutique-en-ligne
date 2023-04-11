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

    public function update(
        $id,
        $firstname,
        $lastname,
        $email,
        $address,
        $zip,
        $phone,
        $password,
        $passwordConfirm
    ) {
        $select = "SELECT * FROM user WHERE id_user=:id";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $id
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
        var_dump($result);

    }
}
