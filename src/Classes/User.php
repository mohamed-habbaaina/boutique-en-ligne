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
        $isUser = $userCount->fetchColumn() != 0;

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
        $resultUser = $prepare->fetch(\PDO::FETCH_ASSOC);

        if (empty($resultUser)) {
            echo "Incorrect email or password.";
            die();
        } elseif (!password_verify($password, $resultUser["password"])) {
            echo "Incorrect email or password.";
            die();
        } else {
            $_SESSION["user"] = [
                "id" => $resultUser["id_user"],
                "firstname" => $resultUser["firstname"],
                "lastname" => $resultUser["lastname"],
                "email" => $resultUser["email"],
            ];
            $select = "SELECT role_wor FROM worker WHERE id_user = :id";
            $prepare = DbConnection::getDb()->prepare($select);
            $prepare->execute([':id' => $resultUser["id_user"]]);
            $resultWorker = $prepare->fetch(\PDO::FETCH_ASSOC);
            if (isset($resultWorker["role_wor"])) {
                $_SESSION["user"]["role"] = $resultWorker["role_wor"];
            }
            echo "Welcome";
        }
    }

    public function getData($id)
    {
        $select = ("SELECT u.*,
            c.address_cus, c.phone_cus, zip_cus,
            w.role_wor
            FROM user u
            LEFT JOIN customer c ON u.id_user = c.id_user
            LEFT JOIN worker w ON u.id_user = w.id_user
            WHERE u.id_user = :id"
        );
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $id
        ]);
        return $prepare->fetch(\PDO::FETCH_ASSOC);

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

    public function updateFirstname($id, $firstname)
    {
        var_dump($id);
        var_dump($firstname);
        $sqlQuery = "UPDATE user 
            SET firstname = :firstname
            WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([
            ':id' => $id,
            ':firstname' => $firstname,
        ]);
    }

    public function updateLastname($id, $lastname)
    {
        $sqlQuery = "UPDATE user 
            SET lastname = :lastname
            WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([
            ':id' => $id,
            ':lastname' => $lastname,
        ]);
    }

    public function updateEmail($id, $email)
    {
        $sqlQuery = "UPDATE user 
            SET email = :email
            WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([
            ':id' => $id,
            ':email' => $email,
        ]);
    }

    public function updateAddress($profil)
    {
        $select = "SELECT address_cus, zip_cus FROM customer WHERE id_user=:id limit 1";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            ':id' => $profil["id_user"]
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            $register = "INSERT INTO customer (id_user, address_cus, zip_cus) VALUES (:id_user, :address, :zip)";
            $prepare = DbConnection::getDb()->prepare($register);

            $prepare->execute([
                "id_user" => $profil["id_user"],
                "address" => $profil["address"],
                "zip" => $profil["postal_code"]
            ]);
            echo "Registed";
        } else {
            $select = "UPDATE customer 
            SET address_cus = :address, zip_cus = :postal_code
            WHERE id_user = :id";
            $prepare = DbConnection::getDb()->prepare($select);
            $prepare->execute([
                ':id' => $profil['id_user'],
                ':address' => $profil['address'],
                ':postal_code' => $profil['postal_code']
            ]);
            echo "Updated";
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

    public function updatePhone($phone, $id)
    {
        $sqlQuery = "UPDATE customer 
            SET phone_cus = :phone
            WHERE id_user = :id";
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([
            ':id' => $id,
            ':phone' => $phone,
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

    public function getUserOrders(int $id)
    {
        $sqlQuery = ("SELECT *
            FROM purshase
            INNER JOIN cart ON purshase.id_cart = cart.id_cart
            INNER JOIN cart_product ON cart.id_cart = cart_product.id_cart
            INNER JOIN product ON cart_product.id_pro = product.id_pro
            WHERE cart.id_user = :id"
        );
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([':id' => $id]);
        $userPurshases = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        // Récupérer les ids des commandes et créer un tableau ou chaque clé représente une commande
        $ordersIds = [];
        $orders = [];
        foreach ($userPurshases as $line) {
            $id_order = $line['id_ord'];
            if (!in_array($id_order, $ordersIds)) {
                $ordersIds[] = $id_order;
            }
            $orders[$id_order][] = $line;
        }
        return $orders;
    }

    public function delUser($id)
    {
        $sqlQuery = ("DELETE FROM `user`
            WHERE `user`.`id_user` = :id"
        );
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([':id' => $id]);

        $sqlQuery = ("DELETE FROM `customer`
            WHERE `id_user` = :id"
        );
        $prepare = DbConnection::getDb()->prepare($sqlQuery);
        $prepare->execute([':id' => $id]);
    }
    public function deconnect(): void
    {
        $_SESSION = array(); 
        session_unset();
        session_destroy();
    }
}
