<?php 

    //database
    include("../database_auth/database_auth.php");

    //get all books from database
    $requete = $mysql->query('select * from book join category on book.category = category.idCategory join author on book.author = author.idAuthor');

?>