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
        <title>Admin - Add article</title>
    </head>
    <body>
        <div class="goback">
            <a href="articles.php">< Back to articles</a>
        </div>
        <div class="form-title">
            <h1>Add an article</h1>
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
        <form class="admin-form" action="resources/add-article-process.php" method="POST" autocomplete="off">
            <label for="">Title</label>
            <?php if(isset($_SESSION['title'])) { ?>
                <input type="text" value="<?php echo $_SESSION['title']; ?>" name="title" maxlength="120" required>
            <?php 
                unset($_SESSION['title']);
            } else { ?>
                <input type="text" name="title" maxlength="120" required>
            <?php } ?>
            <label for="">Article description</label>
            <?php if(isset($_SESSION['description'])) { ?>
                <textarea name="description" id="article-content" rows="6" cols="30" required>
                    <?php
                        echo $_SESSION['description'];
                        unset($_SESSION['description']);
                    ?>
                </textarea>
            <?php } else { ?>
                <textarea name="description" id="article-content" rows="6" cols="30" required></textarea>
            <?php } ?>
            <label for="">Article content</label>
            <?php if(isset($_SESSION['content'])) { ?>
                <textarea name="content" id="article-content" rows="10" cols="30" required>
                    <?php
                        echo $_SESSION['content'];
                        unset($_SESSION['content']);
                    ?>
                </textarea>
            <?php } else { ?>
                <textarea name="content" id="article-content" rows="10" cols="30" required></textarea>
            <?php } ?>
            <script>
                // set CKEDITOR 4 configuration on the textarea element above
                CKEDITOR.replace('content');
            </script>
            <input type="submit" value="Add" name="add">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>