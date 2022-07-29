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

            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                if($_GET['edit'] !== null){
                    $id = $_GET['edit'];
                    $requete = $mysql->prepare('select * from author where idAuthor = ?');
                    $requete->bind_param("i", $id);
                    $requete->execute();
                    $row = $requete->get_result();
                    $author = $row->fetch_assoc();
                }
            }

        ?>
        <div class="goback">
            <a href="authors.php">< Back to authors</a>
        </div>
        <div class="form-title">
            <h1>Edit an author</h1>
        </div>
        <div class="page-message">
            <h4>
                <?php 
                    // message geos here
                    if(isset($_SESSION['auth_msg'])){
                        echo $_SESSION['auth_msg'];
                        unset($_SESSION['auth_msg']);
                    }
                ?>
            </h4>
        </div>
        <form class="admin-form" action="resources/edit-author-process.php" method="POST" autocomplete="off" enctype="multipart/form-data">
            <label for="">Id Author</label>
            <input type="text" name="id" value="<?php echo $author['idAuthor']; ?>" readonly>
            <label for="">First name</label>
            <input type="text" name="firstname" value="<?php echo $author['firstname']; ?>" maxlength="30" required>
            <label for="">Last name</label>
            <input type="text" name="lastname" value="<?php echo $author['lastname']; ?>" maxlength="30" required>
            <label for="">Description</label>
            <textarea name="description" maxlength="800" cols="30" rows="10" required>
                <?php echo  $author['description']; ?>
            </textarea>
            <label for="">Image</label>
            <input type="file" name="image" >
            <input type="submit" value="Edit" name="edit">
        </form>        
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>