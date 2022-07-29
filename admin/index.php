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
        <title>Admin - Dashboard</title>
    </head>
    <body>
        <!-- side nav bar -->
        <?php

            include("includes/side-nav.php");
        
            //get books query
            include("resources/get-books.php");
        
        ?>

        <div class="page-title">
            <h1>List of Books</h1>
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

        <div class="add-link">
            <a href="add-book.php">+ Add a book</a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Book Name</th>
                    <th>Year</th>
                    <th>Cover</th>
                    <th>Author</th>
                    <th>actions</th>
                </tr>
                <?php while($row = $requete->fetch_array()){ ?>
                    <tr>
                        <td>
                            <?php echo $row['nameBook']; ?>
                            <br>
                            <?php if($row['recommended']) { ?>
                                <span>Recommended</span>
                            <?php } ?>
                        </td>
                        <td><?php echo $row['year']; ?></td>
                        <td>
                            <img src="../booksImgs/<?php echo $row['cover']; ?>" alt="Book image">
                        </td>
                        <td>
                            <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                        </td>
                        <td>
                            <a href="edit-book.php?edit=<?php echo $row['idBook']; ?>">Edit</a>
                            <a onclick="return confirm('are you sure ?');" href="resources/delete-book-process.php?delete=<?php echo $row['idBook']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- up button -->
        <?php
            include('includes/up-button.php');
        ?>

        <!-- javascript file -->
        <script src="../public/js/script.js"></script>
    </body>
    </html>
<?php } else { 
        redirect('../login.php');
    }    
?>

