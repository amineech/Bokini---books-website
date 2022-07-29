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
        // database
        include('database_auth/database_auth.php');

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if($_GET['id'] !== null){

                // get data from GET request
                $id_book = $_GET['id'];

                //get chosen book
                $sql = $mysql->prepare('select idBook, nameBook, year, cover, book.description as b_description, category, author, firstname, lastname, nameCategory from book join category on book.category = category.idCategory 
                join author on book.author = author.idAuthor where idBook = ?');
                $sql->bind_param('i', $id_book);
                $sql->execute();
                $row = $sql->get_result();
                $chosen_book = $row->fetch_assoc();

                //get other books with same category
                $sql2 = $mysql->prepare('select * from book where category = ? and idBook not in (?) order by idBook asc limit 5');
                $sql2->bind_param('ii', $chosen_book['category'], $chosen_book['idBook']);
                $sql2->execute();
                $other_books = $sql2->get_result(); // get the result as a set 
            }
        }

        $title = 'Bokini - Details';

    ?>
    <title><?php echo $title; ?></title>
</head>
<body>

    <!-- nav bar -->
    <?php
        include("includes/nav-bar.php");
    ?>

    <div class="details-book">
        <div class="container">
            <div class="inner">
                <div class="title">
                    <h1>Book Overview</h1>
                </div>
                <div class="book-content">
                    <div class="image">
                        <img src="booksImgs/<?php echo $chosen_book['cover']; ?>" alt="Book cover">
                    </div>
                    <div class="details">
                        <h4><?php echo $chosen_book['nameBook']; ?></h4>
                        <?php if($chosen_book['firstname'] !== '' && $chosen_book['lastname'] !== '') { ?>
                            <h4>Written by 
                                <!-- explore author of a book -->
                                <a href="author-overview.php?id=<?php echo $chosen_book['author']; ?>">
                                    <?php echo $chosen_book['firstname'] . ' ' . $chosen_book['lastname']; ?>
                                </a>
                            </h4>
                        <?php } ?>
                        <h4>Year of publication : <?php echo $chosen_book['year'] ?></h4>
                    </div>
                    <div class="overview">
                        <h4><?php echo $chosen_book['nameCategory']; ?></h4>
                        <p><?php echo $chosen_book['b_description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bridge"></div>
    <div class="books">
        <div class="container">
            <div class="inner">
                <div class="title">
                    <h1>Explore similar books</h1>
                </div>
                <div class="books-content">
                    <?php 
                        while($other_book = $other_books->fetch_array()) { 
                    ?>
                        <div class="book">
                            <div class="book-image">
                                <img src="booksImgs/<?php echo $other_book['cover']; ?>" alt="Book Cover">
                                <div class="hidden-infos">
                                    <h4><?php echo $other_book['nameBook']; ?></h4>
                                    <h4><?php echo $other_book['year']; ?></h4>
                                </div>
                            </div>
                            <div class="outer-show">
                                <a href="book-details.php?id=<?php echo $other_book['idBook']; ?>">Show more</a>
                            </div>
                        </div>
                    <?php 
                        // store id of the last displayed book 
                        $book_id = $other_book['idBook'];
                        $book_category = $other_book['category'];
                        } 
                    ?>
                </div>
                <div class="load-more2">
                    <!-- the inputs contain the id and category of the last displayed book -->
                    <button class="load-more-btn">Load more</button>
                    <input type="hidden" value="<?php echo $book_id; ?>" class="val_idBook">
                    <input type="hidden" value="<?php echo $chosen_book['idBook']; ?>" class="val_chosenBook">
                    <input type="hidden" value="<?php echo $book_category; ?>" class="val_categoryBook">
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
        include("includes/footer.php")
    ?>

    <!-- javascript file -->
    <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>