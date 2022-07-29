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
        <title>Admin - Add category</title>
    </head>
    <body>
        <div class="goback">
            <a href="categories.php">< Back to categories</a>
        </div>
        <div class="form-title">
            <h1>Add a category</h1>
        </div>
        <div class="page-message">
            <h4>
                <?php 
                    // message geos here
                    if(isset($_SESSION['ctg_msg'])){
                        echo $_SESSION['ctg_msg'];
                        unset($_SESSION['ctg_msg']);
                    }
                ?>
            </h4>
        </div>
        <form class="admin-form" action="resources/add-category-process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <label for="">Name</label>
            <input type="text" name="category_name" maxlength="30" required>
            <label for="">Image</label>
            <input type="file" name="category_image" required>
            <input type="submit" value="Add" name="add">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>