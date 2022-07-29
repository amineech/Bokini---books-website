<?php 

    session_start();

    //database 
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if($_GET['delete'] !== null){

            $id_catagory = $_GET['delete'];

            $requete1 = $mysql->prepare('select * from category where idCategory = ?');
            $requete1->bind_param('i', $id_catagory);
            $requete1->execute();
            $row = $requete1->get_result();
            $category = $row->fetch_assoc();

            // create file path
            $image_name = $category['imageCategory'];
            $file_path = "../../categoriesImgs/$image_name";

            // check if file path exists
            if(file_exists($file_path)){
                if(unlink($file_path)){ 
                    //delete category from database
                    $requete2 = $mysql->prepare("delete from category where idCategory = ?");
                    $requete2->bind_param('i', $id_catagory);
                    $requete2->execute();
                    $requete2->close();
                    $mysql->close();

                    $_SESSION['ctg_msg'] = "Category deleted successfully";
                } else{
                    $_SESSION['ctg_msg'] = 'Error occured, try again !';
                }
                redirect('../categories.php');
            } else{
                $_SESSION['ctg_msg'] = 'Error occured, try again !';
                redirect('../categories.php');
            }



        }
    }

?>