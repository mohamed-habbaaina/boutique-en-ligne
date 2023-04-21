<?php
namespace src\Classes;
session_start();

require_once('DbConnection.php');

Class Comment{

    public function __construct()
    {

    }

    public function insertComment($text, $id_pro, $id_user){

        $insert = "INSERT INTO comment (date_com, text_com, id_pro, id_user) VALUES (NOW(), :text_com, :id_pro, :id_user)";
        $insertComment = DbConnection::getDb()->prepare($insert);
        $insertComment -> execute([
            "text_com" => $text,
            "id_pro" => $id_pro,
            "id_user" => $id_user
        ]);
    }

    public function selectComment($id_pro){

        $select = "SELECT 
        comment.id_com as id,
        comment.date_com as date,
        comment.text_com as text,
        user.firstname as firstname,
        user.lastname as lastname
        FROM comment
        INNER JOIN user ON user.id_user = comment.id_user
        WHERE id_pro=:id_pro
        ORDER BY date_com DESC";
        $prepare = DbConnection::getDb()->prepare($select);
        $prepare->execute([
            'id_pro' => $id_pro
        ]);
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode($result);

    }
}
?>