<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="public/css/style.css"/>
    <!-- Rendering All Elements Normal-->
    <link rel="stylesheet" href="public/css/normalize.css"/>
    <!-- Font Awesome Library-->
    <link rel="stylesheet" href="public/css/all.min.css"/>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;300;400;500;600;700;800;900&display=swap" 
          rel="stylesheet"
    /> 
    <!-- jquery  -->
    <script src="public/js/jquery-3.6.0.min.js"></script>
    <?php 
        include('resources/get-books.php'); 
    ?>
    <title><?php echo $title; ?></title>
</head>
<body>

    <!-- nav bar -->
    <?php
        include('includes/nav-bar.php');
    ?>

    <!-- page content -->
    <div class="books">
        <div class="container">
            <div class="inner">
                <div class="title">
                    <h1>Explore our collection of Books</h1>
                </div>
                <div class="books-content">
                    <?php while($book = $books->fetch_array()) { ?>
                        <div class="book">
                            <div class="book-image">
                                <img src="booksImgs/<?php echo $book['cover']; ?>" alt="Book Cover">
                                <div class="hidden-infos">
                                    <h4><?php echo $book['nameBook']; ?></h4>
                                    <h4><?php echo $book['year']; ?></h4>
                                </div>
                            </div>
                            <div class="outer-show">
                                <a href="book-details.php?id=<?php echo $book['idBook']; ?>">Show more</a>
                            </div>
                        </div>
                    <?php 
                        // store id of the last displayed book 
                        $book_id = $book['idBook'];
                        } 
                    ?>
                </div>
                <div class="load-more">
                    <!-- the input contain the id of the last displayed book -->
                    <button class="load-more-btn">Load more</button>
                    <input type="hidden" value="<?php echo $book_id; ?>" class="val_idBook">
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include('includes/footer.php'); ?>

    <!-- javascript file -->
    <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
    <!-- the parameter passed in the path to the js file is used to make javascript external file work in .php file ! and it works -->
</body>
</html>