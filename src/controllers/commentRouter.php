<?php
namespace src\controllers;

use src\controllers\CommentController;


require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/controllers/commentController.php');

$commentControler = new CommentController();

if(isset($_GET["fetchComment"])){
        
        $commentControler->getComment($_GET["fetchComment"]);
    }

if(isset($_POST["addComment"])){
    $commentControler->addComment($_POST["commentText"], $_POST["addCommentBtn"], $_SESSION["user"]["id"]);
    echo"ok";
    }
?>
