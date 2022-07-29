<?php 

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['add'])){
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
            $error_msg .= "<br>Text content too long with $plus_characters character !";
        }
        // if something is wrong
        if($error_msg !== ''){
            $_SESSION['article_msg'] = $error_msg;
            $_SESSION['title'] = $title;
            $_SESSION['description'] = $description;            
            $_SESSION['content'] = $content;
            redirect('../add-article.php');
        } else { //all clear
            //store article in database
            $sql = $mysql->prepare('insert into articles (title, description, content) values(?, ?, ?)');
            $sql->bind_param('sss', $title, $description, $content);
            $sql->execute();
            $sql->close();
            $mysql->close();

            $_SESSION['article_msg'] = 'Article added successfully !';
            redirect('../articles.php');
        }
    }

?>