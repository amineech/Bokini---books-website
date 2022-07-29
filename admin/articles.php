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
        <title>Admin - Articles</title>
    </head>
    <body>  
        <!-- side nav bar -->
        <?php
                
            //side nav 
            include("includes/side-nav.php");

            //get authors query
            include("resources/get-articles.php");
        ?>

        <div class="page-title">
            <h1>List of articles</h1>
        </div>

        <!-- display messages -->
        <div class="page-message">
            <h4>
                <?php 
                    // message geos here
                    if(isset($_SESSION['article_msg'])){
                        echo $_SESSION['article_msg'];
                        unset($_SESSION['article_msg']);
                    }
                ?>
            </h4>
        </div>
        <div class="add-link">
            <a href="add-article.php">+ Add an article</a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Title</th>
                    <th>actions</th>
                </tr>
                <?php
                    foreach($reversed_articles as $row){ 
                ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td style="padding-top: 20px;">
                            <a href="edit-article.php?edit=<?php echo $row['idArticle']; ?>">Edit</a>
                            <a onclick="return confirm('are you sure ?');" href="resources/delete-article-process.php?delete=<?php echo $row['idArticle']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>

        <!-- up button -->
        <?php
            include('includes/up-button.php');
        ?>
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>