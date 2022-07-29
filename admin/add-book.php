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
        <title>Admin - Add book</title>
    </head>
    <body>
        <?php 
                    
            //authors
            include('resources/get-authors.php');

            //categories
            include("resources/get-categories.php");

        ?>
        <div class="goback">
            <a href="index.php">< Back to books</a>
        </div>
        <div class="form-title">
            <h1>Add a book</h1>
        </div>
        <div class="page-message">
            <h4>
                <?php 
                    // message goes here
                    if(isset($_SESSION['book_msg'])){
                        echo $_SESSION['book_msg'];
                        unset($_SESSION['book_msg']);
                    }
                ?>
            </h4>
        </div>
        <form class="admin-form" action="resources/add-book-process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <label for="">Name</label>
            <input type="text" name="b_name" maxlength="50" required>
            <label for="">Year</label>
            <input type="number" name="b_year" maxlength="4" required>
            <label for="">Cover</label>
            <input type="file" name="b_cover" required>
            <label for="">Author</label>
            <select name="b_author">
                    <option value="">Choose an author...</option>
                    <?php while($row = $auths->fetch_array()) { ?>
                        <option value="<?php echo $row['idAuthor']; ?>"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></option>
                    <?php } ?>
            </select>
            <label for="">Category</label>
            <select name="b_category">
                    <option value="" >Choose a category...</option>
                    <?php while($row = $ctgs->fetch_array()) { ?>
                        <option value="<?php echo $row['idCategory']; ?>"><?php echo $row['nameCategory']; ?></option>
                    <?php } ?>
            </select>
            <label for="">Description</label>
            <textarea name="b_description" maxlength="500" cols="30" rows="10"></textarea>
            <label class="inline-class" for="">Recommended</label>
            <input type="checkbox" name="status">
            <input type="submit" value="Add" name="add">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>
