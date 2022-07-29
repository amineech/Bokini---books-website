<?php 
    
    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST["add"])){
        $ctg_name = strtoupper(trim($_POST['category_name']));

        // upload infos
        $upload_dir = '../../categoriesImgs/';
        $random_number = "img-" . str_eight_random();
        $file = $upload_dir . "$random_number-" . basename($_FILES['category_image']['name']);
        $image_extension = file_extension($_FILES['category_image']['name']);
        $image_name = "$random_number-" . $_FILES['category_image']['name'];

        if($image_extension !== '.jpg' && $image_extension !== '.jpeg' && $image_extension !== '.png'){
            $_SESSION['ctg_msg'] = 'File type is  invalid !';
            redirect('../add-category.php');
        } else{
            //upload the image on the server 
            if(move_uploaded_file($_FILES['category_image']['tmp_name'], $file)){ // if file is uploaded successfully
                    //store data in database
                    $requete = $mysql->prepare('insert into category(nameCategory, imageCategory) values(?, ?)');
                    $requete->bind_param("ss", $ctg_name, $image_name);
                    $requete->execute();
                    $requete->close();
                    $mysql->close();
        
                    $_SESSION['ctg_msg'] = 'Category added successfully !';
                    redirect("../categories.php");
            } else{
                $_SESSION['ctg_msg'] = 'We encountered a problem, please try again !';
                redirect("../add-category.php");
            }

        }
    }

?>