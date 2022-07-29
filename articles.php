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
        include('functions.php');
        include('resources/get-articles.php'); 
    ?>
    <title><?php echo $title; ?></title>
</head>
<body>

    <!-- nav bar -->
    <?php
        include('includes/nav-bar.php');
    ?>

    <div class="articles">
        <div class="container">
            <div class="inner">
                <div class="articles-content">
                    <?php while($article = $articles->fetch_array()) { ?>
                        <div class="article">
                            <div class="title">
                                <h2>
                                    <!-- article title -->
                                    <?php 
                                        if(strlen($article['title']) > 25)
                                            echo cut_title($article['title']) . '...';
                                        else
                                            echo $article['title'];
                                    ?>
                                </h2>
                            </div>
                            <div class="text-description">
                                <p>
                                    <!-- article content -->
                                    <?php 
                                        if(strlen($article['description']) > 120){
                                            echo cut_article($article['description']) . ' ...';
                                        } else {
                                            echo $article['description'];    
                                        }
                                    ?>
                                </p>
                                <div class="read-more">
                                    <a href="article.php?id=<?php echo $article['idArticle']; ?>">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $article_id = $article['idArticle'];
                    } ?>
                </div>
                <div class="load-more">
                    <button class="load-more-btn">Load more</button>
                    <input type="hidden" value="<?php echo $article_id; ?>" class="val_idArticle">
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