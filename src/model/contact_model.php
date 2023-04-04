<?php

require_once('../Class/ConnectDb.php');

class Message
{
    private ?PDO $db = null;

    public function __construct(
        private string $content,
        private string $firstname,
        private string $lastname,
        private string $email,
        private int $tel,
        private ?int $id = null,
        private ?int $date = null
    ) {
        $this->db = DbConnection::getDb();
    }

    public function register()
    {
        $sql_query = "INSERT INTO `message` (`content_mes`,`firstname_mes`, `lastname_mes`, `email_mes`, `tel_mes`, `date_mes`) 
        VALUES  (:content, :firstname, :lastname, :email, :tel, NOW())";
        $mes_register = $this->db->prepare($sql_query);
        $mes_register->execute([
            'content' => $this->content,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'tel' => $this->tel
        ]);
    }
}
