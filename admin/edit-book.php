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
        <title>Admin - Edit author</title>
    </head>
    <body>
        <?php 

            //database
            include("../database_auth/database_auth.php");

            //authors
            include('resources/get-authors.php');

            //categories
            include("resources/get-categories.php");

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                if($_GET['edit'] !== null){
                    $id_b = $_GET['edit'];
                    $requete = $mysql->prepare('select * from book where idBook = ?');
                    $requete->bind_param("i", $id_b);
                    $requete->execute();
                    $row = $requete->get_result();
                    $book = $row->fetch_assoc();
                }
            }

        ?>
        <div class="goback">
            <a href="index.php">< Back to books</a>
        </div>
        <div class="form-title">
            <h1>Edit a book</h1>
        </div>
        <div class="page-message">
            <h4>
                <?php 
                    // message geos here
                    if(isset($_SESSION['book_msg'])){
                        echo $_SESSION['book_msg'];
                        unset($_SESSION['book_msg']);
                    }
                ?>
            </h4>
        </div>
        <form class="admin-form" action="resources/edit-book-process.php" method="POST" autocomplete="off" enctype="multipart/form-data">
            <label for="">Id Book</label>
                <input type="text" name="b_id" value="<?php echo $book['idBook']; ?>" readonly>
            <label for="">Name</label>
            <input type="text" name="b_name" value="<?php echo $book['nameBook']; ?>" maxlength="50" required>
            <label for="">Year</label>
            <input type="number" name="b_year" value="<?php echo $book['year']; ?>" required>
            <label for="">Cover</label>
            <input type="file" name="b_cover">
            <label for="">Author</label>
            <select name="b_author" required>
                <option value="">Choose an author...</option>
                <?php while($row = $auths->fetch_array()) { ?>
                    <!-- select the author of the edited book -->
                    <?php if($book['author'] == $row['idAuthor']) { ?>
                        <option value="<?php echo $row['idAuthor']; ?>" selected><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $row['idAuthor']; ?>"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <label for="">Category</label>
            <select name="b_category" required>
                <option value="" >Choose a category...</option>
                <?php while($row = $ctgs->fetch_array()) { ?>
                    <!-- select the category of the edited book -->
                    <?php if($book['category'] == $row['idCategory']) { ?>
                        <option value="<?php echo $row['idCategory']; ?>" selected><?php echo $row['nameCategory']; ?></option>
                    <?php } else { ?>    
                        <option value="<?php echo $row['idCategory']; ?>"><?php echo $row['nameCategory']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <label for="">Description</label>
            <textarea name="b_description" maxlength="500" cols="30" rows="10" required>
                <?php echo  $book['description']; ?>
            </textarea>
            <label class="inline-class" for="">Recommended</label>
            <?php if($book['recommended']) { ?>
                <input type="checkbox" name="status" checked>
            <?php } else { ?>
                <input type="checkbox" name="status">
            <?php } ?>
            <input type="submit" value="Edit" name="edit">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>