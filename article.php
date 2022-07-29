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

        include('functions.php');

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_GET['id'])){
                // data from GET request
                $id_article = $_GET['id'];

                // get article
                $sql = $mysql->prepare('select * from articles where idArticle = ?');
                $sql->bind_param('i', $id_article);
                $sql->execute();
                $row = $sql->get_result();
                $article = $row->fetch_assoc();

                // other articles
                $sql2 = $mysql->prepare('select * from articles where idArticle not in(?) order by created_at desc, idArticle desc limit 2');
                $sql2->bind_param('i', $id_article);
                $sql2->execute();
                $other_articles = $sql2->get_result();
            }
        }

        $title = 'Bokini - Article - Read';
    ?>
    <title><?php echo $title; ?></title>
</head>
<body>

    <!-- nav bar -->
    <?php
        include('includes/nav-bar.php');
    ?>

        <!-- chosen article -->
    <div class="article-detail">
        <div class="container">
            <div class="inner">
                <div class="article-inner">
                    <div class="title">
                        <h2>
                            <?php 
                                echo $article['title'];
                            ?>
                            <span>.</span>
                        </h2>
                    </div>
                    <div class="text-content">
                        <?php 
                            echo $article['content'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bridge"></div>

    <!-- more articles -->
    <div class="other-articles">
        <div class="container">
            <div class="inner">
                <div class="title">
                    <h1>
                        Explore other articles
                    </h1>
                </div>
                <div class="content-inner">
                    <?php while($row = $other_articles->fetch_array()) { ?>
                        <div class="title-o">
                            <h4>
                                <?php 
                                    echo $row['title'];
                                ?>
                            </h4>
                            <div class="read-more">
                                <a href="article.php?id=<?php echo $row['idArticle']; ?>">Read more</a>
                            </div>
                        </div>
                    <?php 
                        $last_article = $row['idArticle'];
                    } ?>
                    <div class="load-more">
                        <button class="load-more-btn">Load more</button>
                        <input type="hidden" value="<?php echo $article['idArticle']; ?>" class="chosen_article">
                        <input type="hidden" value="<?php echo $last_article; ?>" class="val_last_idArticle">
                    </div>
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
