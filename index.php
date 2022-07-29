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
    <!-- animate on scroll library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- jquery -->
    <script src="public/js/jquery-3.6.0.min.js"></script>
    <!--  -->
    <title>Bokini - Home</title>
</head>
<body>
    <!-- nav bar -->
    <?php
        include('includes/nav-bar.php');
    ?>

    <!-- Intro text Section Begin -->
    <section class="intro-text">
        <div class="container">
            <div class="inner">
                <h2>
                    Always encouraging the <span>reading culture.</span>
                </h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                    Ea sunt quas aperiam harum eaque voluptates saepe dolorum
                    laboriosam ullam. Ipsum obcaecati magni hic esse qui dolores
                    nemo corporis laboriosam voluptas.
                </p>
            </div>
        </div>
    </section>
    <!-- Intro text Section End -->

    <!-- Websites Section Begin -->
    <section class="recommended-books">
        <div class="container">
            <div class="recommendations">
                <h1>Recommended Books</h1>
            </div>
            <div class="inner">
                <?php
                    include('resources/get-books.php');
                    while($recom_book = $recommended_books->fetch_array()) {
                ?>
                <a href="book-details.php?id=<?php echo $recom_book['idBook']; ?>" target="_blank">
                    <div class="recom-book">
                        <div class="image">
                            <img src="booksImgs/<?php echo $recom_book['cover']; ?>" alt="Writers">
                        </div>
                        <div class="texts">
                            <h4>
                                <?php echo $recom_book['nameBook']; ?>
                            </h4>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Websites Section End -->

    <!-- About Section Begin -->
    <section class="about" data-aos="fade-up" data-aos-duration="700" id="about">
        <div class="container">
            <div class="inner">
                <div class="text text1">
                    <h3>A store that is known on the national level<span>.</span></h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quo, atque? Veniam ea amet iste dolores quam aliquid nam
                        beatae, ullam ad laborum facere dolor ratione ex nobis,
                        sequi culpa laboriosam.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quo, atque? Veniam ea amet iste dolores quam aliquid nam
                        beatae, ullam ad laborum facere dolor ratione ex nobis,
                        sequi culpa laboriosam.
                    </p>
                </div>
                <div class="text text2">
                    <p>
                        As a books store owners, we try to encourage citizens to read more 
                        and sensibilize people about the importance of reading and how it can leave a great impact on people's lives.
                    </p>
                    <p>
                        It is a duty to sensibilize people about the impact of reading in our life.
                    </p>
                    <p>
                        We are happy to have this platform, and be able to communicate with reading lovers.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Intereseted Section Begin -->
        <section class="interested" data-aos="fade-up" data-aos-duration="700">
            <div class="container">
                <div class="inner">
                    <h2 class="title">
                        You Have some interesting ideas to share with us ?
                    </h2>
                    <p class="parag">
                        We are happy to here from you any time, please feel free
                        to share with us your thoughts to improve our services. 
                    </p>
                    <a href="contact.php" class="getInTouch-btn">Get in touch</a>
                </div>
            </div>
        </section>
    <!-- Intereseted Section End -->

    <!-- up button -->
    <?php include('admin/includes/up-button.php'); ?>
    <!-- footer -->
    <?php include('includes/footer.php'); ?>

    <!-- javascript file -->
    <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>