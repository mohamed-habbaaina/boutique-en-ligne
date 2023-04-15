<?php

namespace src\Classes;

session_start();

require_once('DbConnection.php');

class User
{

    public function __construct()
    {
    }

    public function create($firstname, $lastname, $email, $password)
    {
        // Vérifier que l'utilisateur n'existe pas
        $sqlQuery = "SELECT COUNT(email) FROM `user` WHERE email = :email";
        $userCount = DbConnection::getDb()->prepare($sqlQuery);
        $userCount->execute([
            ':email' => $email
        ]);
        $isUser = $userCount->fetchColumn() != 0 ? true : false;

        if ($isUser) {
            echo "Email already exist";
            die();
        } else { 
            // Enregistrer l'utilisateur en base de donnée
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $sqlQuery = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
            $insertUser = DbConnection::getDb()->prepare($sqlQuery);
            $insertUser->execute([
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "password" => $hashed_pwd
            ]);
            // Récupérer l'id de l'utilisateur
            $sqlQuery = "SELECT id_user FROM `user` WHERE email = :email";
            $catchId = DbConnection::getDb()->prepare($sqlQuery);
            $catchId->execute([
                'email' => $email
            ]);
            $idUser = $catchId->fetchColumn();
            // Enregistrer id_user dans la table customer
            $sqlQuery = "INSERT INTO customer (id_user) VALUES (:idUser)";
            $insertIdUser = DbConnection::getDb()->prepare($sqlQuery);
            $insertIdUser->execute([
                "idUser" => $idUser
            ]);
            echo "Registed";
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
        $sqlQuery = "UPDATE user 
            SET firstname = :firstname, lastname = :lastname, email = :email
            WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
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

    public function getAllUserData()
    {
        $select = "SELECT 
        user.id_user as id_user,
        user.firstname as firstname,
        user.lastname as lastname,
        user.email as email,
        customer.address_cus as address,
        customer.zip_cus as zip,
        customer.phone_cus as phone
        FROM user
        INNER JOIN customer ON user.id_user = customer.id_user;
        ";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute();
        $user_result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($user_result);
    }

    public function getUserPurchases(int $id)
    {
        $sqlQuery = (
            "SELECT *
            FROM purshase
            INNER JOIN cart ON purshase.id_cart = cart.id_cart
            INNER JOIN cart_product ON cart.id_cart = cart_product.id_cart
            INNER JOIN product ON cart_product.id_pro = product.id_pro
            WHERE cart.id_user = :id"
            );
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([':id' => $id]);
        $userPurchases = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $userPurchases;
    }
}

// $user = new User();
// $info = $user->getUserPurchases(4);
// echo json_encode($info, JSON_PRETTY_PRINT);