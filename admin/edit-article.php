<?php

    session_start();

    include('../functions.php');

    if(isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Main CSS File -->
        <link rel="stylesheet" href="../public/css/style.css"/>
        <!-- Rendering All Elements Normal-->
        <link rel="stylesheet" href="../public/css/normalize.css"/>
        <!-- Font Awesome Library-->
        <link rel="stylesheet" href="../public/css/all.min.css"/>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;300;400;500;600;700;800;900&display=swap" 
            rel="stylesheet"
        /> 
        <!-- CK-EDITOR 4 CDN for articles -->
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
        <title>Admin - Edit article</title>
    </head>
    <body>
        <?php 

            //database
            include('../database_auth/database_auth.php');

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                if($_GET['edit'] !== null){
                    $id_article = $_GET['edit'];
                    $sql = $mysql->prepare('select * from articles where idArticle = ?');
                    $sql->bind_param("i", $id_article);
                    $sql->execute();
                    $row = $sql->get_result();
                    $article = $row->fetch_assoc();
                }
            }
        ?>
        <div class="goback">
            <a href="articles.php">< Back to articles</a>
        </div>
        <div class="form-title">
            <h1>Edit an article</h1>
        </div>
        <div class="page-message">
            <h4>
                <?php 
                    // message goes here
                    if(isset($_SESSION['article_msg'])){
                        echo $_SESSION['article_msg'];
                        unset($_SESSION['article_msg']);
                    }
                ?>
            </h4>
        </div>
        <form class="admin-form" action="resources/edit-article-process.php" method="POST" autocomplete="off">
            <label for="">Id Article</label>
            <input type="text" name="id_article" value="<?php echo $article['idArticle']; ?>" readonly>
            <label for="">Title</label>
            <input type="text" name="title" value="<?php echo $article['title']; ?>" maxlength="120" required>
            <label for="">Article description</label>
            <textarea name="description" maxlength="20000" id="article-content" rows="6" cols="30" required>
                <?php echo $article['description']; ?>
            </textarea>
            <label for="">Article content</label>
            <textarea name="content" maxlength="20000" id="article-content" rows="10" cols="30" required>
                <?php echo $article['content']; ?>
            </textarea>
            <script>
                // set CKEDITOR 4 configuration on the textarea element above
                CKEDITOR.replace('content');
            </script>
            <input type="submit" value="Edit" name="edit">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>