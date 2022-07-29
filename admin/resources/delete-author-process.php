<?php 

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if($_GET['delete'] !== null){

            $id = $_GET['delete'];

            //delete author image from server
            $requete1 = $mysql->prepare('select * from author where idAuthor = ?');
            $requete1->bind_param('i', $id);
            $requete1->execute();
            $row = $requete1->get_result();
            $author = $row->fetch_assoc();
            $requete1->close();
            
            //create file path
            $image_name = $author['image'];
            $file_path = "../../authorsImgs/$image_name";
            
            //check if file path exists
            if(file_exists($file_path)) {
                if(unlink($file_path)) { 
                    //delete author from database
                    $requete2 = $mysql->prepare('delete from author where idAuthor = ?');
                    $requete2->bind_param('i', $id);
                    $requete2->execute();
                    $requete2->close();
                    $mysql->close();

                    $_SESSION['auth_msg'] = 'Author deleted successfully!';
                } else{
                    $_SESSION['auth_msg'] = 'Error occured, try again !';
                }
            } else{
                $_SESSION['auth_msg'] = 'Error occured, try again !';
            }
            redirect('../authors.php');
        }
    }

?>