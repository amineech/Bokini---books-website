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
        include('resources/get-authors.php'); 
    ?>
    <title><?php echo $title; ?></title>
</head>
<body>

    <!-- nav bar -->
    <?php
        include('includes/nav-bar.php');
    ?>

    <div class="authors">
        <div class="container">
            <div class="inner">
                <div class="title">
                    <h1>Explore available authors</h1>
                </div>
                <div class="authors-content">
                    <?php while($author = $authors->fetch_array()) { ?>
                        <div class="author">
                            <div class="author-image">
                                <img src="authorsImgs/<?php echo $author['image']; ?>" alt="Author Image">
                                <div class="hidden-infos">
                                    <h4><?php echo $author['firstname'] . ' ' . $author['lastname']; ?></h4>
                                </div>
                            </div>
                            <div class="outer-show">
                                <a href="author-overview.php?id=<?php echo $author['idAuthor']; ?>">Overview</a>
                            </div>
                        </div>
                    <?php 
                        //store id of last displayed author
                        $author_id = $author['idAuthor'];
                        }
                     ?>
                </div>
                <div class="load-more-auth">
                    <!-- the input contain the id of the last displayed author -->
                    <button class="load-more-btn">Load more</button>
                    <input type="hidden" value="<?php echo $author_id; ?>" class="val_idAuthor">
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
        include('includes/footer.php');
    ?>


    <!-- javascript file -->
    <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>