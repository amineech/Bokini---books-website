<?php 
    //database
    include("../database_auth/database_auth.php");

    //get all categories from database
    $ctgs = $mysql->query("select * from category");
?>