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
        $select = "SELECT email FROM user WHERE email=:email limit 1";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':email' => $email
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

        if (!empty($result)) {
            echo "Email already exist";
            die();
        } else {
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $register = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
            $prepare = DbConnection::getDb()->prepare($register);

            $prepare->execute([
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "password" => $hashed_pwd,
            ]);
            echo "Register";
        }
    }

    public function select($email, $password)
    {

        $select = "SELECT * FROM user WHERE email=:email limit 1";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':email' => $email
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
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
            return array_merge($user_result, $customer_result);
        } else {
            return $user_result;
        }
    }

    public function updateProfil($profil)
    {
        $select = "UPDATE user 
            SET firstname = :firstname, lastname = :lastname, email = :email
            WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $profil['id_user'],
            ':firstname' => $profil['firstname'],
            ':lastname' => $profil['lastname'],
            ':email' => $profil['email']
        ]);

        echo "Profil updated";
    }

    public function updateAddress($profil)
    {
        $select = "SELECT * FROM customer WHERE id_user=:id limit 1";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $profil["id_user"]
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            $register = "INSERT INTO customer (id_user, address_cus, zip_cus, phone_cus) VALUES (:id_user, :address, :zip, :phone)";
            $prepare = DbConnection::getDb()->prepare($register);

            $prepare->execute([
                "id_user" => $profil["id_user"],
                "address" => $profil["address"],
                "zip" => $profil["postal_code"],
                "phone" => $profil["phone"],
            ]);
            echo "Register";
        } else {
            $select = "UPDATE customer 
            SET address_cus = :address, zip_cus = :postal_code, phone_cus = :phone
            WHERE id_user = :id";
            $prepare = DbConnection::getDb()->prepare($select);
            $prepare->execute([
                ':id' => $profil['id_user'],
                ':address' => $profil['address'],
                ':postal_code' => $profil['postal_code'],
                ':phone' => $profil['phone']
            ]);
        }
    }

    public function updatePassword($id, $password)
    {
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE user SET password = :password WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($update);
        $prepare->execute([
            ':password' => $hashed_pwd,
            ':id' => $id
        ]);
    }
}
