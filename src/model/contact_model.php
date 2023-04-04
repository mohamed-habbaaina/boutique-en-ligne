<?php

require_once('../Class/ConnectDb.php');

class Message
{
    public function __construct(
        private string $content,
        private string $firstname,
        private string $lastname,
        private string $email,
        private int $tel,
        private ?int $id = null,
        private ?int $date = null
    ) {
    }

    public function register()
    {
        $db = DbConnection::getDb();

        $sql_query = "INSERT INTO `message` (`content_mes`,`firstname_mes`, `lastname_mes`, `email_mes`, `tel_mes`, `date_mes`) 
        VALUES  (:content, :firstname, :lastname, :email, :tel, NOW())";
        $mes_register = $db->prepare($sql_query);
        $mes_register->execute([
            'content' => $this->content,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'tel' => $this->tel
        ]);

        $sql_query =  "SELECT `id_mes`, `date_mes` 
        FROM `message` 
        WHERE id = :lastId";
        $get_id_date = $db->prepare($sql_query);
        $get_id_date->execute([
            'lastId' => $db->lastInsertId()
        ]);
        $fetchAssoc = $get_id_date->fetch(PDO::FETCH_ASSOC);
        $this->id = $fetchAssoc['id_mes'];
        $this->date = $fetchAssoc['date_mes'];
    }
}
