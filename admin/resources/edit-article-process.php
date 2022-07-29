<?php 

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['edit'])){
        $id_article = $_POST['id_article'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $content = trim($_POST['content']);

        //data validation
        $error_msg = '';
        if(strlen($description) > 200){
            $error_msg .= 'description should be under 200 character';
        }
        if(strlen($content) > 20000){
            $plus_characters = strlen($content) - 20000;
            $_SESSION['article_msg'] = "Text content too long with $plus_characters character !";
            redirect("../edit-article.php?edit=$id_article");
        }
        // if something is wrong
        if($error_msg !== ''){
            $_SESSION['article_msg'] = $error_msg;
            redirect("../edit-article.php?edit=$id_article");
        } else{ // all clear
            //edit data in database
            $sql = $mysql->prepare('update articles set title = ?, description = ?, content = ? where idArticle = ?');
            $sql->bind_param('sssi', $title, $description, $content, $id_article);
            $sql->execute();
            $sql->close();
            $mysql->close();

            $_SESSION['article_msg'] = 'Article edited successfully !';
            redirect('../articles.php');
        }
    }

?>