<?php 

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['edit'])){
        //get data from the form
        $id_category = $_POST['id_ctg'];
        $category_name = strtoupper(trim($_POST['category_name']));

        //upload infos
        $upload_dir = '../../categoriesImgs/';
        $random_number = "img-" . str_eight_random();
        $file = $upload_dir . "$random_number-" . basename($_FILES['image']['name']);
        $image_extension = file_extension($_FILES['image']['name']);
        $image_name = "$random_number-" . $_FILES['image']['name'];

        //data validation
        if(!empty($image_extension)) { // if extension not empty (means that file not empty)
            if($image_extension !== '.jpg' && $image_extension !== '.jpeg' && $image_extension !== '.png' ){
                    $_SESSION['ctg_msg'] = 'File type is invalid !';   
                    redirect("../edit-category.php?edit=$id_category");
            }
        }

        //if image is uploaded => delete old image and store new one along with other category data
        if($_FILES['image']['size'] !== 0) { 
            //delete old image
            $sql = $mysql->prepare("select * from category where idCategory = ?");
            $sql->bind_param('i', $id_category);
            $sql->execute();
            $row = $sql->get_result();
            $category = $row->fetch_assoc();
            $old_image = $category['imageCategory'];
            $old_image_path = $upload_dir . $old_image;
            unlink($old_image_path);

            //upload new image to the server
            move_uploaded_file($_FILES['image']['tmp_name'], $file);

            //update category
            $sql = $mysql->prepare('update category set nameCategory = ?, imageCategory = ? where idCategory = ?');
            $sql->bind_param("ssi", $category_name, $image_name, $id_category);
            $sql->execute();
            $sql->close();
            $mysql->close();
        
        } else { // if image not uploaded update just other category data
            //update category
            $sql = $mysql->prepare('update category set nameCategory = ? where idCategory = ?');
            $sql->bind_param("si", $category_name, $id_category);
            $sql->execute();
            $sql->close();
            $mysql->close();
        }

        $_SESSION['ctg_msg'] = 'Category edited successfully !';
        redirect('../categories.php');
    }    
?>  