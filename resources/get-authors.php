<?php 

    // database
    include('database_auth/database_auth.php');

    $authors = $mysql->query('select * from author order by idAuthor asc limit 5');

    //to store the id of the last displayed author
    $author_id = '';

    $title = 'Bokini - Authors';

?>