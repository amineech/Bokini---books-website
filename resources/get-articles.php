<?php

    //database
    include('database_auth/database_auth.php');

    // all 10 first articles
    $articles = $mysql->query("select * from articles order by created_at desc, idArticle desc limit 6");

    // to store last displayed book
    $article_id = '';

    // Page title
    $title = 'Bokini - Articles';

?>