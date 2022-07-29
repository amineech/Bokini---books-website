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
        <title>Admin - Categories</title>
    </head>
    <body>
        <!-- side nav bar -->
        <?php
            
            //side nav 
            include("includes/side-nav.php");

            //get authors query
            include("resources/get-categories.php");
        ?>

        <div class="page-title">
            <h1>List of categories</h1>
        </div>

        <!-- display messages -->
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
        <div class="add-link">
            <a href="add-category.php">+ Add a category</a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php while($row = $ctgs->fetch_array()){ ?>
                    <tr>
                        <td><?php echo $row['nameCategory']; ?></td>
                        <td>
                            <img src="../categoriesImgs/<?php echo $row['imageCategory']?>" alt="category image">
                        </td>
                        <td>
                            <a href="edit-category.php?edit=<?php echo $row['idCategory']; ?>">Edit</a>
                            <a onclick="return confirm('are you sure ?');" href="resources/delete-category-process.php?delete=<?php echo $row['idCategory']; ?>">Delete</a>
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