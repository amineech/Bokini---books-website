<?php 

    //redirect to a page
    function redirect($url){
        header("location: $url");
        die();
    }

    //extract the exetension of a file 
    function file_extension($file_name){
        return strtolower(substr($file_name, strripos($file_name, '.')));
    }

    //generate random string of 8 characates
    function str_eight_random(){
        $str = 'ab087128576512cdefghijklmnop891768275812qrstusfjlngjkdgdlmlkegvwxyz123wef456we78j1516171hishf81920';
        return substr(str_shuffle($str), -8); // extract last 8 characters of a random string
    } 

    // subtring from article
    function cut_article($description){
        return substr($description, 0, 120);
    }

    // cut title
    function cut_title($title){
        return substr($title, 0, 25);
    }
?>