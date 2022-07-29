<?php 
    //database
    include("../database_auth/database_auth.php");

    //get all authors from database
    $auths = $mysql->query("select * from author");
    
?>