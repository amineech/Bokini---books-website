<?php

    //database
    include('database_auth/database_auth.php');

    // all 10 first books 
    $books = $mysql->query("select * from book order by idBook asc limit 10");

    // recommended books
    $recommended_books = $mysql->query('select * from book where recommended = 1');

    // to store last displayed book
    $book_id = '';

    // Page title
    $title = 'Bokini - Books';

?>