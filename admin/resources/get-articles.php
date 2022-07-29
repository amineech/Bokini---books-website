<?php 

    include('../database_auth/database_auth.php');
    
    $articles = mysqli_query($mysql, 'select * from articles');

    $result = $articles->fetch_all(MYSQLI_ASSOC); // all result rows as an associative array

    $reversed_articles = array_reverse($result); // display last => first !

?>