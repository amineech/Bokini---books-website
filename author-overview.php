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

                // get data from get request
                $id_author = $_GET['id'];

                // get chosen author
                $sql = $mysql->prepare('select * from author where idAuthor = ?');
                $sql->bind_param('i', $id_author);
                $sql->execute();
                $row = $sql->get_result();
                $chosen_author = $row->fetch_assoc();

                // get other authors
                $sql2 = $mysql->prepare('select * from author where idAuthor not in (?) order by idAuthor asc limit 5');
                $sql2->bind_param('i', $id_author);
                $sql2->execute();
                $other_authors = $sql2->get_result();

            }
        }

        $title = 'Bokini - Author Overview';
    ?>

    <title><?php echo $title; ?></title>
</head>
<body>

    <!-- nav bar -->
    <?php
        include('includes/nav-bar.php');
    ?>


    <div class="auth-overview">
        <div class="container">
            <div class="inner">
                <div class="author-overview-content">
                    <div class="image">
                        <img src="authorsImgs/<?php echo $chosen_author['image']; ?>" alt="Author Image">
                    </div>                
                    <div class="auth-infos">
                        <h1>Author Overview<span>.</span></h1>
                        <h2><?php echo $chosen_author['firstname'] . ' ' . $chosen_author['lastname']; ?></h2>
                        <p>
                            <?php echo $chosen_author['description']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bridge"></div>

    <div class="authors">
        <div class="container">
            <div class="inner">
                <div class="title">
                    <h1>Other authors</h1>
                </div>
                <div class="authors-content">
                    <?php while($author = $other_authors->fetch_array()) { ?>
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
                <div class="load-more-auth2">
                    <!-- the inputs contain the id of the last displayed author and the chosen one -->
                    <button class="load-more-btn">Load more</button>
                    <input type="hidden" value="<?php echo $chosen_author['idAuthor']; ?>" class="val_chosenAuthor">
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