<?php 

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if($_GET['delete'] !== null){
            $id_b = $_GET['delete'];
            
            //delete book image from server
            $requete1 = $mysql->prepare('select * from book where idBook = ?');
            $requete1->bind_param('i', $id_b);
            $requete1->execute();
            $row = $requete1->get_result();
            $book = $row->fetch_assoc();
            $requete1->close();

            //create file path
            $image_name = $book['cover'];
            $file_path = "../../booksImgs/$image_name";

            // check if file path exists
            if(file_exists($file_path)){
                if(unlink($file_path)){
                    //delete book from database
                    $requete2 = $mysql->prepare("delete from book where idBook = ?");
                    $requete2->bind_param('i', $id_b);
                    $requete2->execute();
                    $requete2->close();
                    $mysql->close();
                    
                    $_SESSION['book_msg'] = 'Book deleted successfully !';
                } else{
                    $_SESSION['book_msg'] = 'Error occured, try again !';
                }
            } else{
                $_SESSION['book_msg'] = 'Error occured, try again !';
            }
            redirect('../index.php');
        }
    }


?>