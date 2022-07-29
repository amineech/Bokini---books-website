<?php

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if($_GET['delete'] !== null){
            $id_article = $_GET['delete'];

            //delete from database
            $sql = $mysql->prepare('delete from articles where idArticle = ?');
            $sql->bind_param('i', $id_article);
            $sql->execute();
            $sql->close();
            $mysql->close();

            $_SESSION['article_msg'] = 'Article deleted successfully !';
            redirect('../articles.php');
        } else {
            $_SESSION['article_msg'] = 'Problem encoutered a Problem, please try again !';
            redirect('../articles.php');
        }
    }

?>