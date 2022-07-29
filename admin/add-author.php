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
        <title>Admin - Add author</title>
    </head>
    <body>
        <div class="goback">
            <a href="authors.php">< Back to authors</a>
        </div>
        <div class="form-title">
            <h1>Add an author</h1>
        </div>
        <div class="page-message">
            <h4>
                <?php 
                    // message goes here
                    if(isset($_SESSION['auth_msg'])){
                        echo $_SESSION['auth_msg'];
                        unset($_SESSION['auth_msg']);
                    }
                ?>
            </h4>
        </div>
        <form class="admin-form" action="resources/add-author-process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <label for="">First name</label>
            <input type="text" name="firstname" maxlength="30" required>
            <label for="">Last name</label>
            <input type="text" name="lastname" maxlength="30" required>
            <label for="">Description</label>
            <textarea name="description" maxlength="800" cols="30" rows="10" required></textarea>
            <label for="">Image</label>
            <input type="file" name="image" required>
            <input type="submit" value="Add" name="add">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>