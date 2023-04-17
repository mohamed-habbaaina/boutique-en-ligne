<?php
namespace src\controllers;
use src\Classes\Comment;
require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/Classes/Comment.php');

Class CommentController{

    public $comment;
    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function addComment($text, $id_pro, $id_user){
        $this->comment->insertComment($text, $id_pro, $id_user);
        echo"ok";
    }
    public function getComment($id_pro){
       return $this->comment->selectComment($id_pro);
    }
}
?>