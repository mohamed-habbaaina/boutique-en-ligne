<?php

namespace src\model;

use src\Classes\DbConnection;
use src\Classes\Message;

require_once("../Classes/DbConnection.php");
require_once("../Classes/Message.php");

class ContactModel
{
    // La méthode register prend en paramètre un objet de type Message
    public function register(Message $message)
    {
        // Si on récupère une instance de la connexion à la base de données
        if ($db = DbConnection::getDb()) {

            // On prépare une requête SQL pour insérer les données du message dans la table `message`
            $sql_query = "INSERT INTO `message` (`content_mes`,`firstname_mes`, `lastname_mes`, `email_mes`, `tel_mes`, `date_mes`) 
                VALUES  (:content, :firstname, :lastname, :email, :tel, NOW())";
            $mes_register = $db->prepare($sql_query);
            // On exécute la requête en passant les valeurs des champs du message
            $mes_register->execute([
                'content' => $message->getContent(),
                'firstname' => $message->getFirstname(),
                'lastname' => $message->getLastname(),
                'email' => $message->getEmail(),
                'tel' => $message->getPhone()
            ]);

            // On prépare une requête SQL pour récupérer l'ID et la date du message inséré
            $sql_query =  "SELECT `id_mes`, `date_mes` 
                FROM `message` 
                WHERE id_mes = :lastId";
            $get_id_date = $db->prepare($sql_query);
            // On exécute la requête en passant l'ID du dernier enregistrement inséré
            $get_id_date->execute([
                'lastId' => $db->lastInsertId()
            ]);
            // On récupère les données sous forme de tableau associatif
            $fetchAssoc = $get_id_date->fetch(\PDO::FETCH_ASSOC);
            // On met à jour l'objet Message avec l'ID et la date récupérés
            $message->setId($fetchAssoc['id_mes']);
            $message->setDate($fetchAssoc['date_mes']);
        }
    }

    public function getAllMessages()
    {
        $sql_query = ("SELECT id_mes, firstname_mes, lastname_mes, date_mes
            FROM `message`"
        );
        $prepare = DbConnection::getDb()->prepare($sql_query);
        $prepare->execute();
        $messages = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $messages;
    }
}
